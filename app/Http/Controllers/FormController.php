<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationEditFormRequest;
use App\Profession;
use Illuminate\Http\Request;
use App\Http\Requests\ApplicationFormRequest;
use App\FormSubmission as Form;
use Illuminate\Support\Facades\DB;
use App\MaritialStatus;
use App\Gender;
use App\UniList;
use App\BloodGroup;
use App\District;
use App\Organization;
use App\PlayerLebel;
use Laracasts\Utilities\JavaScript;


class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $user = auth()->user();
        $year_id = (int)session()->get('year_id');
        if ($user->type == 0) {
            if ($form = \App\User::find($user->id)->submissions()->where('year_id', $year_id)->first()) {
                return redirect('/application-form/' . $form->trackingNumber)->with('error', __('You already have a submission pending'));
            }
        }
        $currently_selected = date('Y');
        $earliest_year = 2000;
        $latest_year = date('Y');
        $job=(session()->get('type'));

        $divisions = DB::table('divisions')
            ->get();
        $aJobs = \App\Sport::all();
        $designations = \App\Designation::all();
        $religions = \App\Religion::all();
        $eduBoards = \App\PlayerType::all();
        $playerTypes  = \App\PlayerType::all();
        $playerLebels = \App\PlayerLebel::all();
        $Marital_Status = MaritialStatus::all();
        $genders=Gender::all();
        $BloodGroups=BloodGroup::all();
        $districts=District::all();
        $concentrations=Organization::all();
        $PlayerLebels=PlayerLebel::all();
        $uniLists=UniList::all();
        $professions=\App\Profession::all();
        $max=\App\Club::all()
            ->where('id',1)
        ->first();

        $signSize=\App\Club::all()
            ->where('id',2)
            ->first();




        return view('form')->with(compact("designations","job","divisions", "playerTypes","playerLebels", "religions", "aJobs", 'user',
            'year_id','Marital_Status', 'genders', 'BloodGroups','districts','latest_year','playerLebels','eduBoards',
            'concentrations','uniLists','currently_selected','earliest_year','professions','max','signSize'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationFormRequest $request)
    {
        // validate incoming request

        $form = $request->save();
        return $form->trackingNumber;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $form = Form::where('trackingNumber', $id)->with('upazila.district', 'presentUpazila.district')->firstOrFail();
       

        if (!$form->photo) {
            $form->photo = 'photo/default-avatar.png';
        }

        $data['profession'] = $this->getProfession();
        $data['playerTypes'] = $this->getPlayerType();
        $data['playerLebels'] = $this->getPlayerLebel();
        $data['form'] = $form;

        return view('show-form')->with($data);
    }


    private function getProfession()
    {
        $professions = DB::table('professions')->get();
        $pr = [];
        foreach ($professions as $row) {
            $pr[$row->id] = $row->name;
        }
        return $pr;
    }

    private function getPlayerType()
    {
        $playerTypes = DB::table('player_types')->get();
        $pt = [];
        foreach ($playerTypes as $rows) {
            $pt[$rows->id] = $rows->name;
        }
        return $pt;
    }

    private function getPlayerLebel()
    {
        $playerLebels = DB::table('player_lebels')->get();
        $pl = [];
        foreach ($playerLebels as $rowa) {
            $pl[$rowa->id] = $rowa->name;
        }
        return $pl;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $form=Form::find($id);

        //current address

        $districts  = DB::table('districts')->where('division_id', $form->upazila->district->division_id)->get();
        $upazilas   = DB::table('upazilas')->where('district_id', $form->upazila->district->id)->get();

        $user = auth()->user();
        $year_id = (int)session()->get('year_id');


        $divisions = DB::table('divisions')
            ->get();
        $sports = \App\Sport::all();
        $currently_selected = date('Y');
        $earliest_year = 2000;
        $latest_year = date('Y');
        $job=(session()->get('type'));

        $divisions = DB::table('divisions')
            ->get();
        $aJobs = \App\Sport::all();
        $designations = \App\Designation::all();
        $religions = \App\Religion::all();
        $eduBoards = \App\PlayerType::all();
        $playerTypes  = \App\PlayerType::all();
        $playerLebels = \App\PlayerLebel::all();
        $Marital_Status = MaritialStatus::all();
        $genders=Gender::all();
        $BloodGroups=BloodGroup::all();
        $districts=District::all();
        $concentrations=Organization::all();
        $PlayerLebels=PlayerLebel::all();
        $uniLists=UniList::all();
        $professions=\App\Profession::all();
        $professions = \App\Profession::all();
        $playerTypes = \App\PlayerType::all();
        $playerLebels = \App\PlayerLebel::all();
        return view('edit-form')->with(compact("designations","job","divisions", "playerTypes","playerLebels", "religions", "aJobs", 'user',
            'year_id','Marital_Status', 'genders', 'BloodGroups','districts','latest_year','eduBoards',
            'concentrations','uniLists','currently_selected','earliest_year','professions',"divisions",'form',  "playerTypes", "professions", "sports", 'user','districts','upazilas', 'year_id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicationEditFormRequest $request, $id)
    {
        $form=$request->save($request, $id);
        return redirect('http://127.0.0.1:8000/application-form/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
