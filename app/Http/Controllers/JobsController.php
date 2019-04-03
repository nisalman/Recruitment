<?php

namespace App\Http\Controllers;

use App\Sport;
use Illuminate\Http\Request;
use App\Religion;
use DB;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $professions = DB::table('sports')
            ->select('sports.*')
            ->orderBy('sports.id', 'asc')
            ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.jobs.list', ['professions' => $professions])->render());
        }

        return view('setup.jobs.index',['professions' => $professions]);

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

        $professions = Sport::create($request->only(['name','ssc','hsc', 'grad','postGrad','status']));
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
        $professions = DB::table('sports')
            ->select('sports.*')
            ->where('sports.id', $id)
            ->orderBy('sports.id', 'asc')
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
        return Sport::where('id', $id)->update($request->only(['name','ssc','hsc', 'grad','postGrad','status']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sport::find($id)->delete();
        return 1;
    }
}
