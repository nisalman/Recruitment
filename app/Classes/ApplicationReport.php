<?php

namespace App\Classes;

use App\Libraries\SearchPanel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ApplicationReport
{

    public function getApplicationReport(Request $request, $status = 0)
    {
        $user = request()->user();
        $table = $this->getQuery();
      //  $this->queryRoleCondition($table, $user);
        if ($request->ajax()) {
            $this->queryCondition($table, $request);
        }
        return $table;
    }

    private function getQuery()
    {
        $table = DB::table('form_submissions AS app')
            ->select(
                'app.id',
                'app.name AS applicant_name',
                'app.annualIncome AS annual_income',
                'app.mobile',
                'app.rating',
                'app.motherName AS regOA',
                'app.APname',
                'app.APpos',
                'app.poootao',
                'pt.name AS player_type',
                'd.name AS district_bn_name',
                'd.app_limit',
                's.name AS sport_name',
                'app.status',
                'app.appliedPosition',
                'app.bankAccNo',
                'app.bankBranch',
                'app.photo'

            )
            ->leftJoin('upazilas AS u', 'app.permenentThana', '=', 'u.id')
            ->leftJoin('districts AS d', 'u.district_id', '=', 'd.id')
            ->leftJoin('sports AS s', 'app.sport_id', '=', 's.id')
            ->leftJoin('player_types AS pt', 'app.playerType', '=', 'pt.id');

        return $table;
    }

    private function queryCondition($table, $request)

    {if ($district = (int)$request->get('district_id')) $table->where('d.id', $district);
        if ($sport_id = (int)$request->get('sport_id')) $table->where('s.id', $sport_id);
        if ($player_type = (int)$request->get('player_type_id')) $table->where('pt.id', $player_type);
        $app_status = (int)$request->get('app_status');
        if ($app_status) {
            $app_status = ($app_status == 100) ? 0 : $app_status;
            $table->where('app.status', $app_status);
        }
        if ($applicant_name = trim($request->get('applicant_name'))) $table->where('app.name', 'LIKE', "%{$applicant_name}%");
        if ($tracking_number = trim($request->get('tracking_number'))) $table->where('app.trackingNumber', 'LIKE', "%{$tracking_number}%");
        if ($applicant_mobile = toEnglish(trim($request->get('applicant_mobile')))) $table->where('app.mobile', 'LIKE', "%{$applicant_mobile}%");

        //take searched year, otherwise take active year from session
        $year_id = $request->get('year_id') ? (int)$request->get('year_id') : (int)session()->get('year_id');
        $table->where('app.year_id', $year_id);
    }

    private function queryRoleCondition($table, $user)
    {
        if ($user->hasRole(['dc'])) $table->whereIn('app.status', [0,1,2,3,4]);
        if ($user->hasRole(['ministry'])) $table->whereIn('app.status', [1, 3]);
        if ($user->hasRole(['bsc'])) $table->whereIn('app.status', [2, 4]);
    }

    public function getSearchPanel()
    {
        $user = request()->user();
        $searchObj = new SearchPanel();
        $searchBox = $searchObj->getSearchBox();
        $searchBox['district_list_flag'] = $user->hasRole(['dc']) ? 0 : 1;
        $searchBox['sports_list_flag'] = 1;
        $searchBox['applicant_mobile_flag'] = 1;
        $searchBox['applicant_name_flag'] = 1;
        $searchBox['trackingNumber_flag'] = 1;
        $searchBox['player_type_list_flag'] = 1;
        $searchBox['app_status_flag'] = 1;
        return $searchBox;
    }
} 