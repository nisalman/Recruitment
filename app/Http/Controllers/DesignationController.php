<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;
use DB;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $designations = DB::table('designations')
                        ->select('designations.*')
                        ->orderBy('designations.id', 'asc')
                        ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.designation.list', ['designations' => $designations])->render());
        }

        return view('setup.designation.index',['designations' => $designations]);

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $designations = Designation::create($request->only(['name','status']));
        return $designations;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $designations = DB::table('designations')
            ->select('designations.*')
            ->where('designations.id', $id)
            ->orderBy('designations.id', 'asc')
            ->get();
        $designations = $designations ? $designations[0] : [];
        return response()->json($designations);

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
        return Designation::where('id', $id)->update($request->only(['name', 'status']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Designation::find($id)->delete();
        return 1;
    }
}
