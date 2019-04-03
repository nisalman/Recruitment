<?php

namespace App\Http\Controllers;

use App\room;
use App\center;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $count = DB::table('rooms')
            ->select('rooms.capacity','rooms.id')
            ->orderBy('rooms.id','asc')
            ->get();

        $rooms = room::with('center')
            ->orderBy('rooms.id', 'asc')
            ->get();

        $centers = center::all();

        if ($request->ajax()) {
            return response()->json(view('setup.room.list', ['rooms' => $rooms], ['centers' => $centers])->render());
        }
        return view('setup.room.index', ['rooms' => $rooms], ['centers' => $centers]);

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
        $rooms = room::create($request->only(['center_id', 'name', 'capacity','location', 'floor', 'status']));
        return $rooms;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {




        $rooms = DB::table('rooms')
            ->select('rooms.*')
            ->where('rooms.id', $id)
            ->orderBy('rooms.id', 'asc')
            ->get();
        $rooms = $rooms ? $rooms[0] : [];
        return response()->json($rooms);

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
        return room::where('id', $id)->update($request->only([ 'name','center_id','capacity', 'location', 'floor', 'status']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        room::find($id)->delete();
        return 1;
    }
}
