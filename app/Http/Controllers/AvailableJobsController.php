<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Sport;
use App\Http\Requests\ApplicationFormRequest;

class AvailableJobsController extends Controller
{
    public function index()
    {
        $availableJobs=Sport::all();
        return view('availableJobs', compact('availableJobs'));
    }
    public function apply($id)
    {

        $aJobs = DB::table('sports')
            ->where('id', $id)
            ->first();
        session(['type' => $aJobs]);

        return redirect()->action('FormController@index');

        /*eturn view('form')->with(compact('aJobs'));*/
    }
    public function store(Request $request)
    {
        dd($request->mobile);
        // validate incoming request
        $form = $request->save();
        return $form->trackingNumber;
    }
}
