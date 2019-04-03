<?php

namespace App\Classes;

use App\Libraries\SearchPanel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class SitReport
{

    public function getSitReport(Request $request, $status = 0)
    {
        $user = request()->user();
        $table = $this->getQuery();
        //  $this->queryRoleCondition($table, $user);
        if ($request->ajax()) {
            $this->queryCondition($table, $request);
        }
        return $table;
    }

    private function getQuery()
    {
        $table = DB::table('form_submissions AS app')
            ->select(
                'app.id',
                'app.name AS applicant_name',
                's.name AS sport_name',
                'app.status',
                'app.appliedPosition',
                'app.bankAccNo',
                'app.bankBranch',
                'ex.seat_id',
                'app.trackingNumber',
                'rm.name as room_name',
                'rm.floor',
                'rm.capacity',
                'rm.id as room_id',
                'cen.name as center_name',
                'mark.preli',
                'mark.written',
                'mark.viva',
                'mark.total',
                //'(mark.preli + mark.written + mark.viva) AS total',
                'mark.rank',
                'mark.id as mark_id',
                'mark.allow'


            )
            ->leftJoin('sports AS s', 'app.sport_id', '=', 's.id')
            ->leftJoin('exams AS ex', 'app.trackingNumber', '=', 'ex.trackingNumber')
            ->leftJoin('rooms AS rm', 'rm.id', '=', 'ex.seat_id')
            ->leftJoin('centers AS cen', 'rm.center_id', '=', 'cen.id')
            ->leftJoin('marks AS mark', 'app.trackingNumber', '=', 'mark.trackingNumber');

        return $table;
    }

    private function queryCondition($table, $request)

    {
        if ($district = (int)$request->get('district_id')) $table->where('d.id', $district);
        if ($sport_id = (int)$request->get('sport_id')) $table->where('s.id', $sport_id);
        if ($center_id = (int)$request->get('center_id')) $table->where('cen.id', $center_id);
        if ($room_id = (int)$request->get('room_id')) $table->where('rm.id', $room_id);
        if ($player_type = (int)$request->get('player_type_id')) $table->where('pt.id', $player_type);
        $app_status = (int)$request->get('app_status');
        if ($app_status) {
            $app_status = ($app_status == 100) ? 0 : $app_status;
            $table->where('app.status', $app_status);
        }
        if ($applicant_name = trim($request->get('applicant_name'))) $table->where('app.name', 'LIKE', "%{$applicant_name}%");
        if ($tracking_number = trim($request->get('tracking_number'))) $table->where('app.trackingNumber', 'LIKE', "%{$tracking_number}%");
        if ($applicant_mobile = toEnglish(trim($request->get('applicant_mobile')))) $table->where('app.mobile', 'LIKE', "%{$applicant_mobile}%");

        //take searched year, otherwise take active year from session
        $year_id = $request->get('year_id') ? (int)$request->get('year_id') : (int)session()->get('year_id');
        $table->where('app.year_id', $year_id);
    }

    private function queryRoleCondition($table, $user)
    {
        if ($user->hasRole(['dc'])) $table->whereIn('app.status', [0, 1, 2, 3, 4]);
        if ($user->hasRole(['ministry'])) $table->whereIn('app.status', [1, 3]);
        if ($user->hasRole(['bsc'])) $table->whereIn('app.status', [2, 4]);
    }

    public function getSearchPanel()
    {
        $user = request()->user();
        $searchObj = new SearchPanel();
        $searchBox = $searchObj->getSearchBox();
        $searchBox['district_list_flag'] = $user->hasRole(['dc']) ? 0 : 1;
        $searchBox['sports_list_flag'] = 1;
        $searchBox['center_list_flag'] = 1;
        $searchBox['room_list_flag'] = 1;
        $searchBox['applicant_mobile_flag'] = 1;
        $searchBox['applicant_name_flag'] = 1;
        $searchBox['trackingNumber_flag'] = 1;
        $searchBox['player_type_list_flag'] = 1;
        $searchBox['app_status_flag'] = 1;
        return $searchBox;
    }
} 