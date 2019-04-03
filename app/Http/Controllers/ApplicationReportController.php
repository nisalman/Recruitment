<?php

namespace App\Http\Controllers;
use Illuminate\Pagination;
use Session;
use Illuminate\Http\Request;
use App\Classes\ApplicationReport;
use App\Classes\ApplicationReportList;
use PDF;
use DB;

class ApplicationReportController extends Controller
{
    public function index(Request $request)
    {

        // print_r(session());
        $data = [];
        $arObject = new ApplicationReport();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationReport($request, 0);

        if ($request->ajax()) {
            $page = $request->per_page;
        }
        $table->whereIn('app.status', [1, 2]);
        $table->where('app.is_delete', 0);
        $data['records'] = $table->paginate((int)isset($page) ? $page : 50);
        $data['searchBox'] = $searchBox;

        if ($request->ajax()) {
            return response()->json(view('report.application.list','')->with($data)->render());
        }
        return view('report.application.index')->with($data);
    }


    public function user_report(Request $request)
    {
        // print_r(session());
        $data = [];
        $arObject = new ApplicationReport();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationReport($request, 0);

        if ($request->ajax()) {
            $page = $request->per_page;
        }
        $table->whereIn('app.status', [1, 2]);
        $table->where('app.is_delete', 0);
        $data['records'] = $table->paginate((int)isset($page) ? $page : 50);
        $data['searchBox'] = $searchBox;

        if ($request->ajax()) {
            return response()->json(view('report.application-report.user_list')->with($data)->render());
        }
        return view('report.application-report.index')->with($data);
    }

    public function downloadPDF(Request $request)
    {
        // echo 'hi';exit();


        $data = [];
        $arObject = new ApplicationReport();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationReportList($request, 0);

        if ($request->ajax()) {
            $page = $request->per_page;
        }
        $table->whereIn('app.status', [1, 2]);
        $table->where('app.is_delete', 0);
        $records = $table->paginate((int)isset($page) ? $page : 50);

        // $data['records'] = $table->paginate((int) isset($page) ? $page : 50);
        $data['searchBox'] = $searchBox;

        $records = $table->paginate((int)isset($page) ? $page : 50);


        $pdf = PDF::loadView('report.application-report.user_list', compact('records'));
        return $pdf->download('user_list.pdf');

    }

    public function indexPrint(Request $request)
    {
        // print_r(session());
        $data = [];
        $arObject = new ApplicationReport();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationReport($request, 0);

        if ($request->ajax()) {
            $page = $request->per_page;
        }
        $table->whereIn('app.status', [1, 2]);
        $table->orderBy('app.rating', 'ASC');
        $data['records'] = $table->paginate((int)isset($page) ? $page : 50);
        $data['searchBox'] = $searchBox;

        if ($request->ajax()) {
            return response()->json(view('report.application-print.list')->with($data)->render());
        }
        return view('report.application-print.index')->with($data);
    }
    public function new(Request $request)
    {
        $data = [];
        $arObject = new ApplicationReport();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationReport($request,1);

        $table->where('app.year_id',2);
        $data['records'] = $table->get();
        $data['searchBox'] = $searchBox;

        if ($request->ajax()) {
            return response()->json(view('report.newReport.new_list')->with($data)->render());
        }
        return view('report.newReport.index')->with($data);

////        dd($forms);
//        if ($request->ajax()) {
//            return response()->json(view('report.newReport.new_list', ['forms' => $forms])->render());
//        }
//
//        return view('report.newReport.index', ['forms' => $forms]);
    }

}
