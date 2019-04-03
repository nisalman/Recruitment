<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Sport;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $availableJobs=Sport::all();
        return view('index', compact('availableJobs'));

    }

    public function general(){
        return view('general');
    }

    public function notfound(){
        return view('index');
    }
    public function fatal(){
        return view('index');
    }
}
