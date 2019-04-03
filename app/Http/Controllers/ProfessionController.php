<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profession;
use DB;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $professions = DB::table('professions')
                        ->select('professions.*')
                        ->orderBy('professions.id', 'asc')
                        ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.profession.list', ['professions' => $professions])->render());
        }

        return view('setup.profession.index',['professions' => $professions]);

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

        $professions = Profession::create($request->only(['name','status']));
        return $professions;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professions = DB::table('professions')
            ->select('professions.*')
            ->where('professions.id', $id)
            ->orderBy('professions.id', 'asc')
            ->get();
        $professions = $professions ? $professions[0] : [];
        return response()->json($professions);

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
        return Profession::where('id', $id)->update($request->only(['name', 'status']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Profession::find($id)->delete();
        return 1;
    }
}
