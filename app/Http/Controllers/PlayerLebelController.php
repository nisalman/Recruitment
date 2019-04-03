<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayerLebel;
use DB;

class PlayerLebelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $player_lebels = DB::table('player_lebels')
                        ->select('player_lebels.*')
                        ->orderBy('player_lebels.id', 'asc')
                        ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.player-lebel.list', ['player_lebels' => $player_lebels])->render());
        }

        return view('setup.player-lebel.index',['player_lebels' => $player_lebels]);

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

        $player_lebels = PlayerLebel::create($request->only(['name','status']));
        return $player_lebels;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player_lebels = DB::table('player_lebels')
            ->select('player_lebels.*')
            ->where('player_lebels.id', $id)
            ->orderBy('player_lebels.id', 'asc')
            ->get();
        $player_lebels = $player_lebels ? $player_lebels[0] : [];
        return response()->json($player_lebels);

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
        return PlayerLebel::where('id', $id)->update($request->only(['name', 'status']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PlayerLebel::find($id)->delete();
        return 1;
    }
}
