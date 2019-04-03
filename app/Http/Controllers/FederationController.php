<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Federation;
use DB;

class FederationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        if (request()->has('draw')) {
//            return datatables()->of(Federation::query())
//                ->addColumn('name', function ($sport) {
//                    return $sport->editableName;
//                })
//                ->addColumn('status', function ($sport) {
//                    return $sport->editableStatus;
//                })
//                ->addColumn('address', function ($sport) {
//                    return $sport->editable('address');
//                })
//                ->addColumn('sport_id', function ($sport) {
//                    return $sport->editableSport;
//                })
//                ->rawColumns(['name', 'status', 'address', 'sport_id'])
//                ->toJson(true);
//        }
        $federations = DB::table('federations')
                        ->leftJoin('sports', 'federations.sport_id', '=', 'sports.id')
                        ->select('federations.*', 'sports.name as sport_name')
                        ->orderBy('federations.id', 'asc')
                        ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.federation.list', ['federations' => $federations])->render());
        }

        return view('setup.federation.index',['federations' => $federations]);

//        return view('setup.federation')->with(compact('federations'));
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

        $federations = Federation::create($request->only(['name', 'address', 'status', 'sport_id']));
        return $federations;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $federations = DB::table('federations')
            ->leftJoin('sports', 'federations.sport_id', '=', 'sports.id')
            ->select('federations.*', 'sports.name as sport_name')
            ->where('federations.id', $id)
            ->orderBy('federations.id', 'asc')
            ->get();
        $federations = $federations ? $federations[0] : [];
        return response()->json($federations);

    }
    public function deleteisExist($id)
    {
        $fid = DB::table('federations')
            ->where('sport_id', $id)
            ->first()->id;
            if($fid){
                $this->destroy($fid);
            }
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
        return Federation::where('id', $id)->update($request->only(['name', 'status', 'sport_id', 'address']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Federation::find($id)->delete();
        return 1;
    }
}
