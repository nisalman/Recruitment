<?php

namespace App\Http\Controllers;

use App\Association;
use Illuminate\Http\Request;
use DB;

class AssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $associations = DB::table('associations')
            ->leftJoin('sports', 'associations.sport_id', '=', 'sports.id')
            ->select('associations.*', 'sports.name as sport_name')
            ->orderBy('associations.id', 'asc')
            ->paginate(20);

        if ($request->ajax()) {
            return response()->json(view('setup.association.list', ['associations' => $associations])->render());
        }

        return view('setup.association.index',['associations' => $associations]);
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
        $associations = Association::create($request->only(['name', 'address', 'status', 'sport_id']));
        return $associations;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $associations = DB::table('associations')
            ->leftJoin('sports', 'associations.sport_id', '=', 'sports.id')
            ->select('associations.*', 'sports.name as sport_name')
            ->where('associations.id', $id)
            ->orderBy('associations.id', 'asc')
            ->get();
        $records = $associations ? $associations[0] : [];
        return response()->json($records);
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
        return Association::where('id', $id)->update($request->only(['name', 'status', 'sport_id', 'address']));
    }
    public function deleteisExist($id)
    {
        $fid = DB::table('associations')
            ->where('sport_id', $id)
            ->first()->id;
            if($fid){
                $this->destroy($fid);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Association::find($id)->delete();
        return 1;
    }
}
