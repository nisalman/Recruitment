<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Classes\SitReport;
use DB;
use \Form;
//use App


class MarksEntryController extends Controller
{
    public function index(Request $request){
        $data = [];
        $arObject = new SitReport();
        $searchBox = $arObject->getSearchPanel();
        $table = $arObject->getSitReport($request);


        if ($request->ajax()) {
            $page = $request->per_page;
        }
        //$table->where('app.year_id', 2);
        $table->where('app.status', 4);
        //$table->orderBY('d.id', 'asc');

        $data['records'] = $table->get();
        $data['searchBox'] = $searchBox;


        return view('setup.marks-entry',$data);
    	//return view('layouts')->with('admin',$all_district);

    }
    public function edit(Request $request){


        $pr = ($request->input('pr'));
        $wr = ($request->input('wr'));
        $vi = ($request->input('vi'));
        $total = ($request->input('tot'));


        $pre = $this->saveDataWithFieldName($pr, 'preli');
        $wr = $this->saveDataWithFieldName($wr, 'written');
        $vi = $this->saveDataWithFieldName($vi, 'viva');

       $this->saveDataWithFieldName($total, 'total');

        $pre['type']=1;
        $wr['type']=2;
        $vi['type']=3;
       echo json_encode($pre);

    }

    protected function saveDataWithFieldName($arr_data, $field_name = ''){
        try {
            if(!$field_name || !is_array($arr_data))  return array('status' => false, 'message' => "Parameter Not Set");

            $filter_arr = array_filter($arr_data, function ($val, $key) {
                return !is_null($val[0]);
            }, ARRAY_FILTER_USE_BOTH);

            DB::beginTransaction();
            foreach ($filter_arr as $key => $val) {
                DB::table('marks')
                    ->where('id', $key)
                    ->update([$field_name => $val[0]],['total' => $val[0]]);

            }
            DB::commit();
            return array('status' => true, 'message' => "Update Successfully Done");
        }catch (\Exception $e){
            DB::rollback();
            return array('status' => false, 'message' => "Update Error");
        }


    }




}
