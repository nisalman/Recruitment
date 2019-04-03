<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayerType;
use DB;

class PlayerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $player_types = DB::table('player_types')
                        ->select('player_types.*')
                        ->orderBy('player_types.id', 'asc')
                        ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.player-type.list', ['player_types' => $player_types])->render());
        }

        return view('setup.player-type.index',['player_types' => $player_types]);

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

        $player_types = PlayerType::create($request->only(['name','status']));
        return $player_types;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player_types = DB::table('player_types')
            ->select('player_types.*')
            ->where('player_types.id', $id)
            ->orderBy('player_types.id', 'asc')
            ->get();
        $player_types = $player_types ? $player_types[0] : [];
        return response()->json($player_types);

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
        return PlayerType::where('id', $id)->update($request->only(['name', 'status']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PlayerType::find($id)->delete();
        return 1;
    }
}
