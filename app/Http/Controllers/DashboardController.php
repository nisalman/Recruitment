<?php

namespace App\Http\Controllers;
Use Carbon\Carbon;
use Illuminate\Http\Request;
use App\FormSubmission;
class DashboardController extends Controller
{
    public function index()
    {
        $submissionDate = FormSubmission::whereDate('created_at', Carbon::today())->get();
        $todaySubmit=count($submissionDate);

        $yearId = (int)session()->get('year_id');

        $total = auth()->user()->accessableSubmissions()->where('year_id', $yearId)->whereIn('status', [0, 1, 2, 3, 4, 5])->count();

        $pending = auth()->user()->accessableSubmissions()->where('is_delete', 0)->where('year_id', $yearId)->where('status', 0)->count();
        $approved = auth()->user()->accessableSubmissions()->where('is_delete', 0)->where('year_id', $yearId)->whereIn('status', [3, 4])->count();
        $sendToBkkf = auth()->user()->accessableSubmissions()->where('status', '2')->where('year_id', $yearId)->count();
        $sendToMinistry = auth()->user()->accessableSubmissions()->where('status', '1')->where('year_id', $yearId)->count();
        $rejected = auth()->user()->accessableSubmissions()->where('is_delete', 1)->where('year_id', $yearId)->count();

        return view('dashboard')->with(compact('rejected', 'total', 'pending', 'approved', 'sendToMinistry', 'sendToBkkf', 'todaySubmit'));
    }
}
