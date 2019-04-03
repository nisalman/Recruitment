<?php

namespace App\Http\Controllers;

use App\Club;
use App\FormSubmission;
use Illuminate\Http\Request;
use App\FormSubmission as Form;
use DB;
use App\Document;
use Intervention\Image\Facades\Image as Image;

class FormSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $forms = DB::table('form_submissions as app')
            ->leftJoin('player_lebels', 'app.playerLevel', '=', 'player_lebels.id')
            ->leftJoin('sports', 'app.sport_id', '=', 'sports.id')
            ->select('app.*', 'sports.name as sport_name', 'player_lebels.name as player_name')
            ->orderBy('app.id', 'asc')
            ->where('app.status', 0)
            ->get();

//        if($request->has('removeFromList'))
//        {
//            return $this->removeFromList($request->removeFromList);
//        }
//        if($request->has('forward'))
//        {
//            return $this->forward();
//        }
//        if(request()->has('draw'))
//        {
//            return $this->draw();
//        }
        if ($request->ajax()) {
            return response()->json(view('submission.list', ['forms' => $forms])->render());
        }

        return view('submission.index', ['forms' => $forms]);

//        return view('submissions', compact('forms'));
    }

    public function forward()
    {
        return $this->submissions()->orderBy('rating', 'asc')->where('rating', 0)->where('status', 0)->where('fw', 0)->update(['fw' => 1]);
    }

    public function removeFromList($id)
    {
        Form::where('id', $id)->update(['rating' => 0]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $form = Form::find($request->id);
        $form->rating = $request->rating;
        $form->status = $request->status;
        $form->save();

    }

    /**
     *
     * Send data to table
     *
     */

    public function draw()
    {
        return datatables()
            ->of($this->submissions())
            ->filter(function ($form) {
                $this->additionalFilter($form);
            })
            ->addColumn('playerLevel', function ($form) {
                return $form->playerLevel;
            })
            ->addColumn('statusHtml', function ($form) {
                return $this->statusGenerator($form);
            })
            ->addColumn('achievements', function ($form) {
                return $form->achievementsAsHtml();
            })
            ->addColumn('rating', function ($form) {
                return $form->priorityAsHtml();
            })
            ->rawColumns(['playerLevel', 'achievements', 'rating', 'statusHtml'])
            ->toJson(true);
    }

    public function selectedForms()
    {

        return $this->submissions()->orderBy('rating', 'asc')->where('rating', '!=', NULL)->where('status', '!=', NULL)->where('fw', 0)->get();
    }

    public function update(Request $request, $id)
    {
        $form = FormSubmission::find($id);
        $form->rating = $request->rating;
        $form->status = 5;
        $form->fw = 1;
        $form->save();
        return $form;
    }

    public function isDuplicateNID(Request $request)
    {
        if (trim($request->nid) == '') {
            return 0;
            exit;
        }

        $res = DB::table('form_submissions')
            ->where('form_submissions.NID', $request->nid)
            ->where('form_submissions.year_id', \App\Year::where('status', 1)->value('id'))
            ->first();

        echo $res ? 1 : 0;
        exit;
    }
    // public function checkuserNIDAjax(Request $request)
    //   {
    //   // echo 'hisfhj';exit();

    //   $NID= $request->nid;exit();

    //       if(trim($NID)!= '')
    //       {

    //            $res = DB::table('form_submissions')
    //            ->where('form_submissions.NID',$NID)
    //            ->first();
    //            //echo '<pre>';print_r($res);exit();

    //           //$result = $res->num_rows();
    //           if($res)
    //           {
    //               echo 'This NID Already Exist !!';

    //           }else
    //           {

    //           }

    //       }

    //   }
    public function statusGenerator($form)
    {
        $user = request()->user();
        if ($user->hasRole(['dc', 'nsc'])) {
            if ($form->status == null) {
                return label(__("Pending"), "warning");
            } elseif ($form->fw == 0) {
                return label(__('Selected'), 'info');
            } elseif ($form->status == 'bkkf') {
                return label(__('BSC'), 'primary');
            } elseif ($form->status == 'ministry') {
                return label(__('Ministry'), 'primary');
            }
        } elseif ($user->hasRole(['ministry', 'bsc'])) {
            if ($form->approval == '0') {
                return label(__('Rejected'), 'danger');
            } elseif ($form->approval == '1') {
                return label(__('Approved'));
            } elseif (!$form->approval) {
                return label(__("Pending"), "primary");
            }
        }
    }

    public function approval()
    {
        $this->form->approval = request()->get('approval');
        $this->form->save();
    }

    public function add()
    {
        $this->form->rating = request()->rating;
        $this->form->save();
        return ($this->form);
    }

    public function reorder(Request $request)
    {
        $data = $request->except(['_token', 'to']);
        foreach ($data as $key => $value) {
            Form::where('id', $key)->update(['rating' => $value, 'status' => $request->to]);
        }
    }

    public function submissions()
    {
        return request()->user()->accessableSubmissions();
    }

    public function filteredSubmissions()
    {
        return Form::where('id', null);
    }

    public function show($id)
    {
        $data = [];
        $form = Form::findOrFail($id);
        if (!$form) {
            return view('form-detail')->with($data);
        }

        $relation = array(
            1 => 'স্বামী',
            2 => 'স্ত্রী/স্ত্রীগন',
            3 => 'বাবা',
            4 => 'মা',
            5 => 'অবিবাহিত/বিধবা বোন',
            6 => 'নাবালক ভাই'
        );

        $documents = DB::table('documents')
            ->select('title', 'path', 'type')
            ->where('documentable_id', $id)
            ->get();

        $data['certificate'] = '';
        $data['death_certificate'] = '';
        $data['award'] = [];
        $data['many'] = [];
        $data['final'] = [];
        if ($documents) {
            foreach ($documents as $doc) {
                $doc->path = \Storage::url($doc->path);
                if ($doc->type == 'award') {
                    $data['award'][] = $doc;
                } elseif ($doc->type == 'many') {
                    $data['many'][] = $doc;
                } elseif ($doc->type == 'final') {
                    $data['final'][] = $doc;
                } else {
                    $data[$doc->type] = $doc->path;
                }
            }
        }

        $data['relation'] = $relation;
        $data['profession'] = $this->getProfession();
        $data['playerTypes'] = $this->getPlayerType();
        $data['playerLebels'] = $this->getPlayerLebel();
        $data['form'] = $form;

        return view('form-detail')->with($data);

//        $sports = DB::table('form_submissions')
//            ->where('id', $id)
//            ->get();
//        $records = $sports ? $sports[0] : [];
//        return response()->json($records);
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

    public function additionalFilter(&$submissions)
    {
        $request = request();
        if ($request->trackingNumber) {
            $submissions = $submissions->where('trackingNumber', 'LIKE', '%' . $request->trackingNumber . '%');
        }

        if ($request->status) {
            if ($request->status == 'null') {
                $request->status = null;
            }
            $submissions = $submissions->where('status', $request->status);
        }

        if ($request->division && !$request->district) {
            $submissions = $submissions->whereIn('permenentThana', \App\Division::with('upazilas')->find($request->division)->upazilas->pluck('id'));
        }

        if ($request->district) {
            $submissions = $submissions->whereIn('permenentThana', \App\District::with('upazilas')->find($request->district)->upazilas->pluck('id'));
        }

        if ($request->to) {
            $submissions = $submissions->where('to', $request->to);
        }

        if ($request->approval != '') {
            if ($request->approval == 'null') {
                $request->approval = null;
            }
            $submissions = $submissions->where('approval', $request->approval);
        }

        return $submissions;
    }

    public function upload(Request $request)
    {
        $photoDimention = Club::all()
            ->where('id', 1)
            ->first();
        $signDimention = Club::all()
            ->where('id', 2)
            ->first();

        $file = $request->file('file');

        if (!$file) {
            return response()->json(['success' => false]);
        }
        $ext = $file->getClientOriginalExtension();
        $fileName = substr(base_convert(time(), 10, 36) . md5(microtime()), 0, 55) . '.' . $ext;
        $directory = 'storage/' . ($request->type == 'certificate' || $request->type == 'death_certificate' ? 'attachments' : $request->type) . '/';
        $uploadUrl = $directory . $fileName;


        if ($directory != 'storage/photo3/') {
            Image::make($file)->resize($photoDimention->height, $photoDimention->width)->save($uploadUrl);
        } else {
            Image::make($file)->resize($signDimention->height, $signDimention->width)->save($uploadUrl);
        }

        if ($request->type == 'certificate' || $request->type == 'death_certificate') {
            $document = new Document();
            $document->documentable_id = 0;
            $document->documentable_type = 'App\FormSubmission';
            $document->type = $request->type;
            $document->path = $uploadUrl;
            $document->save();

            $ids = session('document_ids') ? session('document_ids') : [];
            array_push($ids, $document->id);
            session(['document_ids' => $ids]);
        } else {
            session([$request->type => $uploadUrl]);
        }

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        FormSubmission::find($id);
        return 1;
//        return view('submission_edit', compact('form'));
    }

    public function appCheck(Request $request)
    {
        $forms = DB::table('form_submissions as app')
            ->leftJoin('player_lebels', 'app.playerLevel', '=', 'player_lebels.id')
            ->leftJoin('sports', 'app.sport_id', '=', 'sports.id')
            ->select('app.*', 'sports.name as sport_name', 'player_lebels.name as player_name')
            ->orderBy('app.id', 'asc')
            ->where('app.status', 5)
            ->get();

        if ($request->ajax()) {
            return response()->json(view('submission_check.list', ['forms' => $forms])->render());
        }

        return view('submission_check.index', ['forms' => $forms]);
    }

}
