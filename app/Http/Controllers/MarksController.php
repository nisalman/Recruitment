<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\SitReport;
use DB;
use Brian2694\Toastr\Toastr as Toastr;
class MarksController extends Controller
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
        return view('setup.district')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo 'a';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
