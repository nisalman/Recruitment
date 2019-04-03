<?php

namespace App\Libraries;

use App\center;
use App\room;
use App\Sport;
use App\District;
use Illuminate\Support\Facades\DB;

/**
 *  serach panel
 */
class SearchPanel
{

    private $searchBox = [
        'district_list' => [],
        'sports_list' => [],
        'center_list' => [],
        'room_list' => [],
        'player_type_list' => [],
        'status' => ['1' => 'Active', '0' => 'Inactive'],
        'app_status' => [],
        'trackingNumber' => '',
        'applicant_name' => '',
        'applicant_mobile' => '',
        'from_date' => '',
        'to_date' => '',
        'common_text_serach' => '',
        'limit' => 25,
        'year' => [],

        'district_list_flag' => 0,
        'sports_list_flag' => 0,
        'center_list_flag' => 0,
        'room_list_flag' => 0,
        'player_type_list_flag' => 0,
        'applicant_name_flag' => 0,
        'applicant_mobile_flag' => 0,
        'app_status_flag' => 0,
        'from_date_flag' => 0,
        'trackingNumber_flag' => 0,
        'to_date_flag' => 0,
        'common_text_search_flag' => 0,
    ];

    function __construct()
    {

    }

    public function getSearchBox()
    {
        $this->searchBox['sports_list'] = self:: getSportsList();
        $this->searchBox['district_list'] = self:: getDistrictList();
        $this->searchBox['player_type_list'] = self:: getPlayerTypeList();
        $this->searchBox['center_list'] = self:: getCenterList();
        $this->searchBox['room_list'] = self:: getRoomList();
        $this->searchBox['app_status'] = self:: getApplicationStatus();
        $this->searchBox['year'] = self:: getYear();
        return $this->searchBox;
    }

    private function getSportsList()
    {
        $records = Sport::all();
        if (!$records) {
            return [];
        }
        return $records;
    }

    private function getDistrictList()
    {
        $records = District::all();
        if (!$records) {
            return [];
        }
        return $records;
    }

    private function getCenterList()
    {
        $records = center::all();
        if (!$records) {
            return [];
        }
        return $records;
    }
    private function getRoomList()
    {
        $records = room::all();
        if (!$records) {
            return [];
        }
        return $records;
    }

    private function getPlayerTypeList()
    {
        $records = DB::table('player_types')->where('status', 1)->get();
        if (!$records) {
            return [];
        }
        return $records;
    }

    private function getApplicationStatus()
    {
        $user = request()->user();
        if ($user->hasRole(['dc', 'nsc'])) {
            $records['100'] = 'প্রক্রিয়াধীন';
            $records['1'] = 'মন্ত্রণালয়';
            $records['2'] = 'Pending';
            $records['3'] = 'অনুমোদন(মন্ত্রণালয়)';
            $records['4'] = 'Approved';
        }
        if ($user->hasRole(['ministry'])) {
            $records['1'] = 'মন্ত্রণালয়';
            $records['3'] = 'অনুমোদন';
        }
        if ($user->hasRole(['bsc'])) {
            $records['2'] = 'Pending';
            $records['4'] = 'Approved';
        }
        return $records;
    }

    private function getYear()
    {
        if (!$records = \App\Year::all()) {
            return [];
        }
        return $records;
    }
}