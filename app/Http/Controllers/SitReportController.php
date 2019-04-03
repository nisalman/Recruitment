<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Session;
use App\Classes\SitReport;
use PDF;



class SitReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // print_r(session());
        $data = [];
        $arObject = new SitReport();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getSitReport($request, 0);

        if ($request->ajax()) {
            $page = $request->per_page;
        }
        /*$table->whereIn('app.status', [1, 2]);*/
        $table->where('app.is_delete', 0);
        $data['records'] = $table->get();
        $data['searchBox'] = $searchBox;
//        $adata=Arr::pluck($data['searchBox']);
        $adata=($data['records'])->groupby('seat_id')->all();

       //dd($adata);
        $d =[];
        foreach ($adata as $key1=>$dt)
        {
            for ($i=0; $i< count($dt); $i++)
            {
                if ($i == 0 || $i == count($dt)-1 ){

                   $d[$key1][] =  $dt[$i]->trackingNumber;
                   $d[$key1]['room_no'] = $dt[$i]->room_id;
                   $d[$key1]['room_name'] = $dt[$i]->room_name;
                   $d[$key1]['capacity'] = $dt[$i]->capacity;
                   $d[$key1]['center_name'] = $dt[$i]->center_name;
                   $d[$key1]['room_floor'] = $dt[$i]->floor;
                }
            }
        }
        $data['records'] =$d;
       // dd(array_keys($d)['1']);
        /*$room=[];
        foreach ($d as $key=>$pdt){
            for ($i=0; $i<(count($d)); $i++)
            {
                $room['number']=array_keys($d)[$i];
                $room['first'][]= $d[$key]['0'];
                $room['last'][]= ($d[$key]['1']);
            }

        }
        dd($room);
        $area = json_encode($d);*/




        /*foreach ($ob as $item) {
            echo $item;
        }*/


        if ($request->ajax()) {

            return response()->json(view('report.sit.user_list', '')->with($data)->render());
        }
        return view('report.sit.index')->with($data)->with($d);    }
}
