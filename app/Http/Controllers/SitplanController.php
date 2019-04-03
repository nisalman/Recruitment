<?php

namespace App\Http\Controllers;

use App\Classes\SitReport;
use App\FormSubmission;
use DB;
use Illuminate\Http\Request;
use Brian2694\Toastr\Toastr as Toastr;

class SitplanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $arObject = new SitReport();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getSitReport($request);


        if ($request->ajax()) {
            $page = $request->per_page;
        }
        //$table->where('app.year_id', 2);
        $table->where('app.status', 4);
        //$table->orderBY('d.id', 'asc');

        $data['records'] = $table->get();
        $data['searchBox'] = $searchBox;


        if ($request->ajax()) {
            return response()->json(view('application_seat_list.list')->with($data)->render());
        }
        return view('application_seat_list.index')->with($data);

        $adata = DB::table('exams')
            ->orderBy('trackingNumber', 'asc')
            ->pluck('trackingNumber');



        $roomNum = DB::table('rooms')
            ->select('id', 'capacity')
            ->get();
        $totalCap = DB::table('form_submissions')
            ->select( 'id','trackingNumber')
            ->orderBy('trackingNumber', 'asc')
            ->get();


        $pid = 0;

        //input sport_id
        foreach ($totalCap as $sit)
        {
            DB::table('exams')
                ->where('trackingNumber', $sit->trackingNumber)
                ->update(
                //['sit_id' => $rn->id]
                    ['form_submissions_id' => $sit->id]
                );

                dump($sit);

        }
exit();

        //end



        foreach ($roomNum as $rn) {

            for ($i = 0;  $i<$rn->capacity; $i++) {

                if ($pid!=count($adata))
                {
                    $a = $adata[$pid];
                    echo $a;
                    echo '<br>';
                    DB::table('exam')
                    ->where('trackingNumber', $a)
                    ->update(
                        //['sit_id' => $rn->id]
                        ['sit_id' => $rn->id]
                    );

                    /*DB::table('exam')
                        ->insert(
                            ['seat_id' => $rn->id, 'trackingNumber' => $a]
                        );*/

                  /*  echo $a . '--' . $rn->name ;
                    echo "<br>";*/
                    $pid++;
                }

            }




        }
        exit();
        for ($i = 0; $i < count($adata); $i++) {
            echo $adata[$i];
            echo "<br>";

        }


        $minTracking = $adata->min('trackingNumber');
        $maxTracking = $adata->max('trackingNumber');
        $totalTracking = $adata->count('trackingNumber');

        for ($minTracking; $minTracking <= $maxTracking; $minTracking++) {
            if (in_array("020002", $adata, TRUE)) {
                echo $minTracking;
            }
        }


        /* echo $maxTracking;
         echo '<br>';
         echo $minTracking;
         echo '<br>';
         echo $totalTracking;*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate()
    {

        $adata = DB::table('form_submissions')
            ->orderBy('trackingNumber', 'asc')
            ->where('status', 4)
            ->pluck('trackingNumber');

        $roomNum = DB::table('rooms')
            ->select('id', 'capacity')
            ->get();
        $totalCap = DB::table('rooms')
            ->select( 'capacity')
            ->count();


        $pid = 0;

        foreach ($roomNum as $rn) {

            for ($i = 0;  $i<$rn->capacity; $i++) {

                if ($pid!=count($adata))
                {
                    $a = $adata[$pid];

                    DB::table('exams')
                        ->where('trackingNumber', $a)
                        ->update(
                            ['seat_id' => $rn->id]
                        );

                    /*DB::table('exam')
                        ->insert(
                            ['seat_id' => $rn->id, 'trackingNumber' => $a]
                        );*/

                    /*  echo $a . '--' . $rn->name ;
                      echo "<br>";*/
                    $pid++;
                }

            }

        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function check()
    {
        Toastr::success('Changes Successfully', 'Update ', ["positionClass" => "toast-top-right"]);
        return view('test');
    }
}
