<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\center;

use Brian2694\Toastr\Facades\Toastr;


class CenterController extends Controller
{
    public function index(Request $request)
    {
        toastr()->success('Data has been saved successfully!');
        $centers = DB::table('centers')
            ->select('centers.*')
            ->orderBy('centers.id', 'asc')
            ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.center.list', ['centers' => $centers])->render());
        }
        return view('setup.center.index', ['centers' => $centers]);

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
        $centers = center::create($request->only(['name', 'num_room', 'location', 'status']));
        Toastr::success('hello', 'Title', ["positionClass" => "toast-top-center"]);
        return $centers;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $centers = DB::table('centers')
            ->select('centers.*')
            ->where('centers.id', $id)
            ->orderBy('centers.id', 'asc')
            ->get();
        $centers = $centers ? $centers[0] : [];
        return response()->json($centers);

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
        $centers= Center::where('id', $id)->update($request->only(['name', 'num_room', 'location', 'status']));
        Toastr::success('hello', 'Title', ["positionClass" => "toast-top-center"]);
        return $centers;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Center::find($id)->delete();
        return 1;
    }
}
