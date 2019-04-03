<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sport;
use App\Association; 
use App\Federation; 
use App\Http\Controllers\FederationController;
use DB;

class SportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sports = DB::table('sports')
            ->leftJoin('federations', 'sports.id', '=', 'federations.sport_id')
            ->leftJoin('associations', 'sports.id', '=', 'associations.sport_id')
            ->select('sports.*', 'federations.name as fedarName', 'associations.name as asso_name')
            ->orderBy('id', 'asc')->get();

        if ($request->ajax()) {
            return response()->json(view('setup.sports.list', ['sports' => $sports])->render());
        }

        return view('setup.sports.index',['sports' => $sports]);
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
        $sport = Sport::create($request->only(['name', 'status', 'federation_id']));
        if ($request->has('federation')) {
            $sport->federations()->create(['name' => "বাংলাদেশ ".$sport->name." ফেডারেশন", 'status' => 1]);
        }
        if ($request->has('association')) {
            $sport->associations()->create(['name' => $sport->name." অ্যাসোসিয়েশান", 'status' => 1]);
        }
        return $sport;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sports = DB::table('sports')
            ->leftJoin('federations', 'sports.id', '=', 'federations.sport_id')
            ->leftJoin('associations', 'sports.id', '=', 'associations.sport_id')
            ->select('sports.id', 'sports.name', 'sports.status', 'federations.id as federations_id', 'associations.id as associations_id')
            ->where('sports.id', $id)
            ->orderBy('id', 'asc')->get();
        $records = $sports ? $sports[0] : [];
        return response()->json($records);
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
        $sport=Sport::where('id', $id)->update($request->only(['name', 'status','federation_id']));
        //echo $request->sports_type." - ".$request->federation." - ".$request->association; exit;

        if ($request->has('federation')) {
            if($request->is_federation==""){
                Federation::create(['name' => "বাংলাদেশ ".$request->name." ফেডারেশন", 'sport_id' => $request->sports_id, 'status' => 1]);
            }
            else{
        Federation::where('id', $request->is_federation)->update(['name' => "বাংলাদেশ ".$request->name." ফেডারেশন", 'sport_id' => $request->sports_id, 'status' => 1]);
        }
        }else{
            if($request->is_federation!=""){
                
                //===== Detete =====
                Federation::find($request->is_federation)->delete();
            }
        }
        if ($request->has('association')) {
            if($request->is_association==""){
            Association::create(['name' => $request->name." অ্যাসোসিয়েশান", 'sport_id' => $request->sports_id, 'status' => 1]);
            }
            else{
        Association::where('id', $request->is_association)->update(['name' => $request->name." অ্যাসোসিয়েশান", 'sport_id' => $request->sports_id, 'status' => 1]);
        }
        }else{
            if($request->is_association!=""){
                //===== Detete =====
                Association::find($request->is_association)->delete();
            }
        }

        return $sport;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fabObject = new FederationController();
        $assObject = new AssociationController();

        $fabObject->deleteisExist($id);
        $assObject->deleteisExist($id);

        Sport::find($id)->delete();

                
        //Association::find($id)->delete();
        return 1;
    }
}
