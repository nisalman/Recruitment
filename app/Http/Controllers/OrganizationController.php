<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use DB;

class OrganizationController extends Controller
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
        $organizations = DB::table('organizations')
                        
                        ->select('organizations.*')
                        ->orderBy('organizations.id', 'asc')
                        ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.organization.list', ['organizations' => $organizations])->render());
        }

        return view('setup.organization.index',['organizations' => $organizations]);

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

        $organizations = Organization::create($request->only(['name', 'representative', 'status']));
        return $organizations;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organizations = DB::table('organizations')
            ->select('organizations.*')
            ->where('organizations.id', $id)
            ->orderBy('organizations.id', 'asc')
            ->get();
        $organizations = $organizations ? $organizations[0] : [];
        return response()->json($organizations);

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
        return Organization::where('id', $id)->update($request->only(['name','representative','status']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Organization::find($id)->delete();
        return 1;
    }
}
