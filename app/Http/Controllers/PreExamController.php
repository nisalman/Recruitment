<?php

namespace App\Http\Controllers;
use App\pre_exam;
use Illuminate\Http\Request;
use DB;
class PreExamController extends Controller
{
    public function index(Request $request)
    {

        $pre_exam = DB::table('pre_exam')
            ->select('pre_exam.*')
            ->orderBy('pre_exam.id', 'asc')
            ->get();

        if ($request->ajax()) {
            return response()->json(view('setup.pre_exam.list', ['pre_exam' => $pre_exam])->render());
        }

        return view('setup.pre_exam.index',['pre_exam' => $pre_exam]);

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

        $pre_exam = Pre_exam::create($request->only(['name','remarks','point','flag']));
        return $pre_exam;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pre_exam = DB::table('pre_exam')
            ->select('pre_exam.*')
            ->where('pre_exam.id', $id)
            ->orderBy('pre_exam.id', 'asc')
            ->get();
//        echo " $('#remarks').val('{$pre_exam->remarks}');";
        $pre_exam = $pre_exam ? $pre_exam[0] : [];
        return response()->json($pre_exam);

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
        return  Pre_exam::where('id', $id)->update($request->only(['point']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pre_exam::find($id)->delete();
        return 1;
    }
}
