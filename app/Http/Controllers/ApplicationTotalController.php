<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ApplicationTotal;

class ApplicationTotalController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $arObject = new ApplicationTotal();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationTotalList($request);


        $table->orderBY('d.id','asc');
        $table->orderBY('app.status','asc');
        $table->orderBY('app.rating','asc');
        $data['records'] = $table->get();
//        $data['records'] = $table->paginate((int) isset($page) ? $page : 10);
        $data['searchBox'] = $searchBox;

        if ($request->ajax()) {
            return response()->json(view('application_list.list')->with($data)->render());

        }
        return view('application_list.index')->with($data);
    }

    public function pending(Request $request)
    {
        $data = [];
        $arObject = new ApplicationTotal();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getApplicationTotalList($request,1);

        if ($request->ajax()) {
            $page = $request->per_page;
        }
        $table->where('app.is_delete', 0);
        $table->orderBY('d.id','asc');
        $table->orderBY('app.status','asc');
        $table->orderBY('app.rating','asc');
         $data['records'] = $table->get();
//        $data['records'] = $table->paginate((int) isset($page) ? $page : 10);
        $data['searchBox'] = $searchBox;

        if ($request->ajax()) {
            return response()->json(view('application_pending_list.list')->with($data)->render());
        }
        return view('application_pending_list.index')->with($data);
    }
}
