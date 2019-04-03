<?php

namespace App\Http\Controllers;
use App\FormSubmission;
use Illuminate\Http\Request;
use DB;

class dumpController extends Controller
{
    public function index()
    {
        $form=DB::table('form_submissions')
            ->where('id',108)
            ->first();
        echo '<pre>';
        print_r($form);
    }
}
