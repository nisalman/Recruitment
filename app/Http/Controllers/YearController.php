<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Year;
use DB;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $years = DB::table('years')
                       
                        ->select('years.*')
                        ->orderBy('years.id', 'asc')
                        ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.year.list', ['years' => $years])->render());
        }

        return view('setup.year.index',['years' => $years]);

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

        $years = Year::create($request->only(['year_name','status']));
        return $years;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $years = DB::table('years')
          
            ->select('years.*')
            ->where('years.id', $id)
            ->orderBy('years.id', 'asc')
            ->get();
        $years = $years ? $years[0] : [];
        return response()->json($years);

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
        return Year::where('id', $id)->update($request->only(['year_name', 'status']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Year::find($id)->delete();
        return 1;
    }
}
