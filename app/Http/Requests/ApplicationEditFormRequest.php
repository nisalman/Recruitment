<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Document;
use Illuminate\Foundation\Http\FormRequest;
use App\FormSubmission;
use Illuminate\Http\Request;
use Image;
use session;
use App\FormSubmission as Form;

class ApplicationEditFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!request()->has('sameAddress')) {
            $data['currentThana'] = "required";

        }

        $data = [
            'name' => 'required',
            'annualIncome' => 'required',
            'profession' => 'required',
            'permenentAddress' => 'required',
            'permenentAddressPostOffice' => 'required',

        ];
        return $data;
    }
    /**
     *
     * Get NIDCopy
     *
     */
//    public function getNIDCopy()
//    {
//        if($this->hasFile('NIDCopy'))
//        {
//            return $this->NIDCopy->store('public/nid');
//        }
//        return null;
//    }

    /**
     *
     * Get Photo
     *
     */
//    public function getPhoto()
//    {
//        if($this->hasFile('photo'))
//        {
//            return $this->photo->store('public/photo');
//        }
//        return null;
//    }


    /**
     *
     * Save the request to related models
     *
     */

    public function post_upload(Request $request, $input)
    {
        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }

        $file = Input::file('file');

        $extension = File::extension($file['name']);
        $directory = path('public') . 'uploads/' . sha1(time());
        $filename = sha1(time() . time()) . ".{$extension}";

        $upload_success = Input::upload('file', $directory, $filename);

        if ($upload_success) {
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function save(Request $request, $id)
    {

        $form = Form::find($id);

        $form->to = $request->to;
        $form->name = $request->name;
        $form->appliedPosition = $request->appliedPosition;
        $form->fatherName = $request->fatherName;
        $form->motherName = $request->motherName;
        $form->mobile = $request->mobile;
        $form->bname = $request->bname;
        $form->profession = $request->profession;
        $form->designation = $request->designation;
        $form->birth = $request->birth;
        $form->NID = $request->NID;
        $form->currentThana = $request->currentAddressThana;
        $form->currentAddress = $request->currentAddress;
        $form->currentAddressPostOffice = $request->currentAddressPostOffice;
        $form->permenentAddress = $request->permenentAddress;
        $form->permenentThana = $request->permenentAddressThana;
        $form->permenentAddressPostOffice = $request->permenentAddressPostOffice;
        $form->annualIncome = $request->annualIncome;
        $form->bankAccNo = $request->quota;
        $form->bankBranch = $request->deptCan;
        $form->sport_id = $request->sport_id;
        $form->playerType = $request->playerType;
        $form->playerLevel = $request->playerLevel;
        $form->country = $request->country;
        $form->federation_id = $request->federation_id;
        $form->club_id = $request->club_id;
        $form->organization_id = $request->organization_id;
        $form->start_year = $request->start_year;
        $form->end_year = $request->end_year;
        $form->description = $request->description;
        $form->APname = $request->APname;

        $form->pito= $request->e1EL;
        $form->poootao= $request->e1BD;
        $form->APss= $request->e1CON;
        $form->APpos= $request->e1INS;
        $form->ponum= $request->e1PY;
        $form->APname= $request->e1R;

        $form->e2EL= $request->e2EL;
        $form->e2BD= $request->e2BD;
        $form->e2CON= $request->e2CON;;
        $form->e2INS= $request->e2INS;
        $form->e2PY= $request->e2PY;
        $form->e2R= $request->e2R;

        $form->e3EL= $request->e3EL;
        $form->e3SJ= $request->e3SJ;
        $form->e3INS= $request->e3INS;
        $form->e3PY= $request->e3PY;
        $form->e3R= $request->e3R;

        $form->photo10= $request->e4EL;
        $form->OEGname= $request->e4SJ;
        $form->NOHname= $request->e4INS;
        $form->PITO2= $request->e4PY;
        $form->mota= $request->e4R;

        $form->user_id = $request->user()->id;

        if (session('photo2') != "") {
            $form->photo2 = session('photo2');
        }
        if (session('photo3') != "") {
            $form->photo3 = session('photo3');
        }

        $form->checkStatus = 0;
        $form->office = $request->office;
        $form->year_id = \App\Year::where('status', 1)->value('id');
        $form->is_special = $request->is_special;
        //$form->is_federation=$request->is_federation;

        if ($request->m_b) {
            $form->status = $request->m_b;
        }

        if ($request->has('for_app')) {
            $form->for_applicaion = 1;
            $form->death_person_name = $request->death_person_name;
            $form->died_man_relation = $request->died_man_relation;
            $form->death = $request->death;
        }
        if ($request->has('for_apps')) {
            $form->is_federation = 1;

        }
        if ($request->has('sameAddress')) {
            $form->currentAddress = $form->permenentAddress;
            $form->currentThana = $form->permenentThana;
            $form->currentAddressPostOffice = $form->permenentAddressPostOffice;
        }
        if ($request->NID != "") {
            $check = \DB::table('form_submissions')->where('NID', $request->NID)->where('year_id', $request->year_id)->get()->count();
        }


        $district = $form->upazila->district;
        $form->trackingNumber = sprintf('%02d', $district->id) . sprintf('%04d', $district->submissions()->count() + 1);


        $form->save();
        $applicationID = $form->id;

        $request->session()->forget('photo2');
        $request->session()->forget('photo3');


        if ($ids = session('document_ids')) {
            \DB::table('documents')->whereIn('id', $ids)->update(['documentable_id' => $applicationID]);
            $request->session()->forget('document_ids');
        }

        return $form;
    }

}
