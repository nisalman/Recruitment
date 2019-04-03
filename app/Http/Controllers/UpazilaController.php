<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upazila;
use DB;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $upazilas = DB::table('upazilas')
                        ->leftJoin('districts', 'upazilas.district_id', '=', 'districts.id')
                        ->select('upazilas.*', 'districts.bn_name as district_name')
                        ->orderBy('upazilas.id', 'asc')
                        ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.upazila.list', ['upazilas' => $upazilas])->render());
        }

        return view('setup.upazila.index',['upazilas' => $upazilas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $upazila = Upazila::create($request->only(['name','bn_name','district_id']));
        return $upazila;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $upazilas = DB::table('upazilas')
            ->leftJoin('districts', 'upazilas.district_id', '=', 'districts.id')
            ->select('upazilas.*', 'districts.name as district_name')
            ->where('upazilas.id', $id)
            ->orderBy('upazilas.id', 'asc')
            ->get();
        $upazilas = $upazilas ? $upazilas[0] : [];
        return response()->json($upazilas);

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
        return Upazila::where('id', $id)->update($request->only(['name','bn_name','district_id']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Upazila::find($id)->delete();
        return 1;
    }
}
