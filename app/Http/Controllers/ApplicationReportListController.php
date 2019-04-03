<?php

namespace App\Http\Controllers;
use Illuminate\Pagination;
use Session;
use Illuminate\Http\Request;
use App\Classes\ApplicationList;
use App\Classes\ApplicationReportList;
use App\Classes\ApplicationTotal;
use PDF;
use DB;
use Maatwebsite\Excel\Facades\Excel;


class ApplicationReportListController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $arObject = new ApplicationReportList();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationReportList($request, 1);

        $table->where('app.year_id', 2);
        $table->where('app.is_delete', 0);
        $table->orderBY('d.id', 'asc');
        $table->orderBY('app.status', 'asc');
        $table->orderBY('app.rating', 'asc');
        $data['records'] = $table->get();
        $data['searchBox'] = $searchBox;

        if ($request->ajax()) {
            return response()->json(view('report.pendingReport.pending_new_list','')->with($data)->render());
        }
        return view('report.pendingReport.index')->with($data);

////        dd($forms);
//        if ($request->ajax()) {
//            return response()->json(view('report.newReport.new_list', ['forms' => $forms])->render());
//        }
//
//        return view('report.newReport.index', ['forms' => $forms]);
    }
    public function list(Request $request)
    {
        $data = [];
        $arObject = new ApplicationReportList();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationReportList($request);

        if ($request->ajax()) {
            $page = $request->per_page;
        }

//        $table->where('app.is_delete', 0);
//        $table->orderBY('d.id', 'asc');
//        $table->orderBY('app.status', 'asc');
        $table->orderBY('app.rating', 'asc');
        $data['records'] = $table->get();
        $data['searchBox'] = $searchBox;





        if ($request->ajax()) {
            return response()->json(view('report.listReport.new_list','')->with($data)->render());
        }
        return view('report.listReport.index')->with($data);

////        dd($forms);
//        if ($request->ajax()) {
//            return response()->json(view('report.newReport.new_list', ['forms' => $forms])->render());
//        }
//
//        return view('report.newReport.index', ['forms' => $forms]);
    }
    public function export()
    {
//        $data = [];
//        $arObject = new ApplicationReportList();
//        $table = $arObject->getApplicationReportList($request);
//        $data['records'] = $table->get();
        $data = ['bjhbhjb' => 'yys','sae'=>'sas'];

        return Excel::download($data, 'users.xlsx');
    }
}
