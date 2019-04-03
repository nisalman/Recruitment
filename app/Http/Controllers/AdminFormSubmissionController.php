<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\District;

class AdminFormSubmissionController extends Controller
{
    /*public function dcApplicationForward(Request $request)
    {
        $status = $request->m_b_id;
        $priority = toEnglish($request->priority);
        $app_id = $request->app_id;
        $count = count($app_id);
        $year_id = \App\Year::where('status', 1)->value('id');
        $user = request()->user();
        $district_id = $user->locationable_id;

        $entry_count = count(array_filter($priority));

        if (!$entry_count) {
            echo json_encode(array('success' => 3, 'message' => 'Please Insert any Value'));
            exit;
        }

        $limit_check = $this->getApplicaionLimitCheck($district_id, $year_id, $priority);
        //  print_r($limit_check['status']);exit;
        if (!$limit_check['status'] && !@role['nsc']) {
            $message = "আর কোন আবেদনপত্র পাঠাতে পারবেন না।" . "অত্র বছরে ইতিমধ্যে " . toBangla($limit_check['db_limit']) . "টি পাঠানো হয়েছে।";
            if ($limit_check['limit']) {
                $message = toBangla($limit_check['limit']) . "টি এর বেশি আবেদনপত্র পাঠাতে পারবেন না।" . "অত্র বছরে ইতিমধ্যে " . toBangla($limit_check['db_limit']) . "টি পাঠানো হয়েছে।";
            }
            echo json_encode(array('success' => 2, 'limit' => $limit_check['app_limit'], 'message' => $message));
            exit;
        }
        DB::beginTransaction();
        try {
            $app_check = $this->checkApplication($year_id, $status, $user);
            $sl = 0;
            for ($i = 0; $i < $count; $i++) {
                if ((int)$priority[$i]) {
                    $sl++;
                    $pir = ($app_check) ? ($app_check + $sl) : (int)$priority[$i];
                    DB::table('form_submissions')
                        ->where('id', $app_id[$i])
                        ->where('rating', 0)
                        ->where('status', 0)
                        ->where('fw', 0)
                        ->where('year_id', $year_id)
                        ->where('is_delete', '=', 0)
                        ->update(
                            [
                                'fw' => 1,
                                'status' => $status,
                                'rating' => trim($pir)
                            ]
                        );
                }
            }
            DB::commit();
            echo json_encode(array('success' => true, 'message' => "Successfully done"));
            exit;
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode(array('success' => false, 'message' => "Error"));
            exit;
        }
    }*/

    private function checkApplication($year_id, $status, $user)
    {

        $disctrict_id = $user->locationable_id;
        $rating = 0;
        $records = DB::table('form_submissions AS app')
            ->select('app.rating')
            ->leftJoin('upazilas AS u', 'app.currentThana', '=', 'u.id')
            ->leftJoin('districts AS d', 'u.district_id', '=', 'd.id')
            ->where('d.id', '=', $disctrict_id)
            ->where('year_id', '=', $year_id)
            ->where('fw', '=', 1)
            ->where('status', '=', $status)
            ->where('is_delete', '=', 0)
            ->orderBy('rating', 'desc')
            ->first();
        if ($records) {
            $rating = $records->rating;
        }
        return $rating;
    }

    private function getApplicaionLimitCheck($district_id = 0, $year_id = 0, $priority = [])
    {
        $data = [];
        $status = true;
        $app_limit = $this->getApplicationLimit($district_id);
        $entry_count = count(array_filter($priority));
        $db_count = $this->getTotalAppCount($district_id, $year_id);
        $total_count = ($entry_count + $db_count);

        if ($total_count > $app_limit) {
            $status = false;
        }
        $data = ['status' => $status, 'limit' => ($app_limit - $db_count), 'app_limit' => $app_limit, 'db_limit' => $db_count];
        return $data;
    }

    private function getApplicationLimit($district_id)
    {
        $app_limit = 0;
        $record = District::find($district_id);
        if ($record) {
            $app_limit = $record->app_limit;
        }
        return $app_limit;
    }

    private function getTotalAppCount($district_id, $year_id)
    {
        $record = DB::table('form_submissions AS app')
            ->leftJoin('upazilas AS u', 'app.currentThana', '=', 'u.id')
            ->leftJoin('districts AS d', 'u.district_id', '=', 'd.id')
            ->where('d.id', '=', $district_id)
            ->where('app.year_id', '=', $year_id)
            ->where('app.is_delete', '=', 0)
            ->where('app.status', '<>', 0)
            ->count();
        return $record;
    }

    public function ForwardtoSuperAdmin(Request $request)
    {

        $app_id = $request->app_id;
        $is_special = 1;
        // echo $is_special;exit();

        $count = count($app_id);
        $year_id = \App\Year::where('status', 1)->value('id');
        $user = request()->user();
        $status = $request->m_b_id;
        if ($user->hasRole(['ministry'])) {
            $status = 3;
        }
        for ($i = 0; $i < $count; $i++) {
            if ($app_id[$i]) {

                DB::table('form_submissions')
                    ->where('id', $app_id[$i])
                    ->where('fw', 0)
                    ->where('year_id', $year_id)
                    ->update(
                        [
                            'status' => $status
                        ]
                    );


            }
        }
        for ($i = 0; $i < $count; $i++) {
            if ($app_id[$i]) {

                DB::table('form_submissions')
                    ->where('id', $app_id[$i])
                    ->where('fw', 1)
                    ->where('year_id', $year_id)
                    ->update(
                        [
                            'status' => $status
                        ]
                    );
            }
        }
    }


    //send to super admin start
    public function mbApplicationForward(Request $request)
    {
        $app_id = $request->app_id;
        $is_special = 1;
        // echo $is_special;exit();

        $count = count($app_id);
        $year_id = \App\Year::where('status', 1)->value('id');
        $user = request()->user();
        $status = 4;
        if ($user->hasRole(['ministry'])) {
            $status = 3;
        }
        for ($i = 0; $i < $count; $i++) {
            if ($app_id[$i]) {

                DB::table('form_submissions')
                    ->where('id', $app_id[$i])
                    ->where('fw', 0)
                    ->where('year_id', $year_id)
                    ->update(
                        [
                            'status' => $status
                        ]
                    );
                $trackings=DB::table('form_submissions')
                    ->select('trackingNumber')
                    ->where('id', $app_id[$i])
                    ->get();


                foreach ($trackings as $tracking)
                {
                    DB::table('marks')->insert(
                        ['trackingNumber' => $tracking->trackingNumber]
                    );
                    DB::table('exams')->insert(
                        ['trackingNumber' => $tracking->trackingNumber]
                    );

                }

            }
        }
        for ($i = 0; $i < $count; $i++) {
            if ($app_id[$i]) {

                DB::table('form_submissions')
                    ->where('id', $app_id[$i])
                    ->where('fw', 1)
                    ->where('year_id', $year_id)
                    ->update(
                        [
                            'status' => $status
                        ]
                    );
            }
        }
    }

    //send to super admin end

    public function dcApplicationDelete(Request $request)
    {
        $app_id = $request->app_id;
        $year_id = \App\Year::where('status', 1)->value('id');
        DB::table('form_submissions')
            ->where('id', $app_id)
            ->where('year_id', $year_id)
            ->update(
                [
                    'is_delete' => 1
                ]
            );
    }
}
