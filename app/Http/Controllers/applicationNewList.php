<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class applicationNewList extends Controller
{
    public function index(Request $request)
    {
        // print_r(session());
        $data = [];
        $arObject = new ApplicationReport();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationReportList($request, 0);

        if ($request->ajax()) {
            $page = $request->per_page;
        }
        $table->whereIn('app.status', [1, 2]);
        $table->where('app.is_delete', 0);
        $data['records'] = $table->paginate((int)isset($page) ? $page : 50);
        $data['searchBox'] = $searchBox;

        if ($request->ajax()) {
            return response()->json(view('report.newReport.new_list','')->with($data)->render());
        }
        return view('report.newReport.index')->with($data);
    }

}
