<?php

namespace App\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Classes\ApplicationList;
use Session;
use DB;
use App\FormSubmission;

class ApplicationListController extends Controller
{
    public function index(Request $request)
    {
        // print_r(session());
        $data = [];
        $arObject = new ApplicationList();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationList($request);


        if ($request->ajax()) {
            $page = $request->per_page;
        }
        $table->where('app.year_id', 2);
        $table->orderBY('d.id', 'asc');

        $data['records'] = $table->get();
        $data['searchBox'] = $searchBox;


        if ($request->ajax()) {
            return response()->json(view('application_list.list')->with($data)->render());
        }
        return view('application_list.index')->with($data);
    }

    public function pending(Request $request)
    {
       /* $marks=DB::table('pre_exam')
            ->where('status', 1)
            ->get();

        echo '<pre>'; print_r($marks); exit();*/

        $data = [];
        $arObject = new ApplicationList();
        $searchBox = $arObject->getPendingSearchPanel();
        $table = $arObject->getApplicationList($request, 1);

        $table->orderBY('app.rating', 'asc');
        $data['records'] = $table->get();
//        $data['records'] = $table->paginate((int)isset($page) ? $page : 50);
        $data['searchBox'] = $searchBox;

        if ($request->ajax()) {
            return response()->json(view('application_pending_list.list')->with($data)->render());
        }
        return view('application_pending_list.index')->with($data);
    }

    public function message($id)
    {
        return view('message-modal')
            ->with('id', $id);

    }

    public function sendMessage(Request $request)
    {
        $data = array();
        $data['id'] = $request->id;
        $data['checkStatus'] = 1;
        $data['message'] = $request->mes;
        DB::table('form_submissions')
            ->where('id', $data['id'])
            ->update($data);
        Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();

    }
}
