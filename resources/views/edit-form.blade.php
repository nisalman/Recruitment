@extends('layouts.web')
@section('header')
    <link href="/plugins/dropzone/dropzone.css" rel="stylesheet">
    <script src="/plugins/dropzone/dropzone.js"></script>
@stop
@section('content')
    @if($errors->any() >0)
        @foreach($errors as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
    @endif
    <!-- Modal -->
    <div id="formConfirm" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">@lang('Are you sure')?</h4>
                </div>
                <div class="modal-body" style="display: inline-block; width: 100%">

                    <!-- show form -->

                    <div id="progress_bar" class="ui-progress-bar ui-container">
                        <div class="ui-progress" style="width: 79%;">
                            <span class="ui-label" style="display:none;">Processing <b class="value">79%</b></span>
                        </div><!-- .ui-progress -->
                    </div><!-- #progress_bar -->


                    <style>
                        .ui-progress span.ui-label {
                            position: absolute;
                            right: 0;
                            color: rgba(0, 0, 0, 0.6);
                            text-shadow: rgba(255, 255, 255, 0.45) 0 1px 0px;
                            white-space: nowrap;
                        }

                        @-webkit-keyframes animate-stripes {
                            from {
                                background-position: 0 0;
                            }
                            to {
                                background-position: 44px 0;
                            }
                        }

                        .ui-progress-bar {
                            position: relative;
                            height: 10px;
                            padding-right: 2px;
                            background-color: #abb2bc;
                            border-radius: 5px;
                            -moz-border-radius: 5px;
                            -webkit-border-radius: 5px;
                            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #b6bcc6), color-stop(1, #9da5b0));
                            background: -moz-linear-gradient(#9da5b0 0%, #b6bcc6 100%);
                            -webkit-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5), 0px 1px 0px 0px #FFF;
                            -moz-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5), 0px 1px 0px 0px #FFF;
                            box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5), 0px 1px 0px 0px #FFF;
                        }

                        .ui-progress {
                            position: relative;
                            display: block;
                            overflow: hidden;
                            height: 10px;
                            -moz-border-radius: 5px;
                            -webkit-border-radius: 5px;
                            border-radius: 5px;
                            -webkit-background-size: 44px 44px;
                            background-color: #74d04c;
                            background: -webkit-gradient(linear, 0 0, 44 44,
                            color-stop(0.00, rgba(255, 255, 255, 0.17)),
                            color-stop(0.25, rgba(255, 255, 255, 0.17)),
                            color-stop(0.26, rgba(255, 255, 255, 0)),
                            color-stop(0.50, rgba(255, 255, 255, 0)),
                            color-stop(0.51, rgba(255, 255, 255, 0.17)),
                            color-stop(0.75, rgba(255, 255, 255, 0.17)),
                            color-stop(0.76, rgba(255, 255, 255, 0)),
                            color-stop(1.00, rgba(255, 255, 255, 0))
                            ), -webkit-gradient(linear, left bottom, left top, color-stop(0, #74d04c), color-stop(1, #9bdd62));
                            background: -moz-repeating-linear-gradient(top left -30deg,
                            rgba(255, 255, 255, 0.17),
                            rgba(255, 255, 255, 0.17) 15px,
                            rgba(255, 255, 255, 0) 15px,
                            rgba(255, 255, 255, 0) 30px
                            ), -moz-linear-gradient(#9bdd62 0%, #74d04c 100%);
                            -webkit-box-shadow: inset 0px 1px 0px 0px #dbf383, inset 0px -1px 1px #58c43a;
                            -moz-box-shadow: inset 0px 1px 0px 0px #dbf383, inset 0px -1px 1px #58c43a;
                            box-shadow: inset 0px 1px 0px 0px #dbf383, inset 0px -1px 1px #58c43a;
                            border: 1px solid #4c8932;
                            -webkit-animation: animate-stripes 2s linear infinite;
                        }
                    </style>


                    {{--<img src="images/loading.gif" id="gifform" style="display: block; margin: 0 auto; width: 100px; visibility: hidden;">--}}

                    <div class="form-detail">
                        <table class="table">

                            <tr>
                                <td>Name</td>
                                <td id="name"></td>
                            </tr>

                            <tr>
                                <td>Legal Status</td>
                                <td id="LegalStatus"></td>
                            </tr>
                            <tr>
                                <td>Registered Official Address</td>
                                <td id="regOA"></td>
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td id="mobile"></td>
                                <td>Fax</td>
                                <td id="fax"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td id="email"></td>
                                <td>Website</td>
                                <td id="website"></td>
                            </tr>
                            <tr>
                                <td>NID</td>
                                <td id="NID"></td>
                                <td>Birth</td>
                                <td id="dob"></td>
                            </tr>
                        </table>
                    </div>

                    <!-- /show form -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success updateForm">@lang('Submit')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12" id="application-form">
        <form class="form-horizontal se-form update-form original" data-name="update-form"  action="{{route('application-form.update',$form->id)}}"  method="post" enctype="multipart/form-data"
              autocomplete="off">
            {{ csrf_field() }}
            {{ method_field('PUT')}}
            <div class="col-md-12 text-center">
                <div style="color: red;"><b style="color: black;">NB: &nbsp;&nbsp;</b>Red Marked(*) Files are mandatory.
                </div>
            </div>

            <input type="hidden" name="year_id" value="{{$year_id}}">
            <div id="loading2" style="display:none;"><img src="{{ asset('images') }}/loading.gif" alt=""/></div>
     {{--Editing Section--}}

                <div class="form-group">
                    <div class="title">General Info</div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Applicant Name<span class="required">*</span> </label>
                            <input name="name" placeholder="Write Full Name" value="{{$form->name}}" type="text" class="form-control">
                            <input name="appliedPosition" type="hidden" >
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-6">
                            <label for="">Father's Name<span class="required">*</span></label>
                            <input name="fatherName" value="{{$form->fatherName}}" placeholder="Father's Name" type="text"
                                   class="form-control">
                        </div>
                        <div class=" col-md-6">
                            <label for="">Mother's Name<span class="required">*</span></label>
                            <input name="motherName" value="{{$form->motherName}}" type="text" class="form-control"
                            >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Mobile Number<span class="required">*</span></label>
                            <input name="mobile" type="text" value="{{$form->mobile}}" value="{{$user->mobile}}"
                                   class="form-control">
                        </div>
                        <div class=" col-md-4">
                            <label for="">Email <span class="required">*</span> </label>
                            <input name="designation" type="text" value="{{$form->designation}}"
                                   class="form-control">
                        </div>

                        <div class=" col-md-4">

                            <label for="">Religion<span class="required">*</span> </label>
                            <select name="profession" id="" class="form-control">
                                <option> ---</option>
                                @foreach($religions as $religion)
                                    <option value="{{$religion->name}}" {{$form->profession == $religion->name  ? 'selected' : ''}}>{{$religion->name}}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Gender</label>
                            <select name="annualIncome" id="" class="form-control">
                                <option> ---</option>
                                @foreach($genders as $gender)
                                    <option value="{{$gender->name}}" {{$form->annualIncome == $gender->name  ? 'selected' : ''}}>{{$gender->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" col-md-4">
                            <label for="">Maritial Status</label>
                            <select name="bname" id="" class="form-control">
                                <option> ---</option>
                                @foreach($Marital_Status as $ms)
                                    <option value="{{$ms->name}}" {{$form->bname == $ms->name  ? 'selected' : ''}}>{{$ms->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" col-md-4">
                            <label for="">Blood Group</label>
                            <select name="playerType" id="" class="form-control">
                                <option> ---</option>
                                @foreach($BloodGroups as $BloodGroup)
                                    <option value="{{$BloodGroup->name}}" {{$form->playerType == $BloodGroup->name  ? 'selected' : ''}}>{{$BloodGroup->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Nationality<span class="required">*</span> </label>
                            <input name="country" id="nid" type="text" placeholder="Write Bangladeshi"
                                   class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label for="">NID<span class="required">*</span> </label>
                            <input name="NID" id="nid" type="text" value="{{$form->NID}}"
                                   class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label for="">Date of Birth <span class="required">*</span> </label>
                            <input name="birth" type="text" value="{{toEnglish($form->birth)}}"
                                   class="form-control datepicker">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Quota<span class="required">*</span> </label>
                            <select name="quota" class="form-control" required="">
                                <option value="">---</option>
                                @foreach($designations as $quota)
                                    <option value="{{$quota->name}}" {{$form->bankAccNo == $quota->name  ? 'selected' : ''}}>{{$quota->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Departmental Candidate Status<span class="required">*</span> </label>
                            <select name="deptCan" class="form-control" required="">
                                <option value="">---</option>
                                @foreach($professions as $deptCan)
                                    <option value="{{$deptCan->name}}" {{$form->bankBranch == $deptCan->name  ? 'selected' : ''}}>{{$deptCan->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="title">Address Detail</div>
                        <br>
                        <div class="form-group ">
                            <div class="title">Permanent Address</div>

                            <div class="col-md-4 ">
                                <label for=""> Division <span class="required">*</span> </label>
                                <select class="form-control division" id="" required="">
                                    <option value="">--</option>
                                    @foreach($divisions as $division)
                                        <option value="{{$division->id}}" {{$form->upazila->district->division_id == $division->id  ? 'selected' : ''}}>{{$division->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 ">
                                <label for=""> District <span class="required">*</span> </label>
                                <select class="form-control district" id="" required="">
                                    <option value="">--</option>
                                    @foreach($districts as $district)
                                        <option value="{{$district->id}}" {{$form->upazila->district->id == $district->id  ? 'selected' : ''}}>{{$district->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for=""> Thana/Upazila/Area <span class="required">*</span> </label>
                                <select name="permenentAddressThana" class="form-control upazila" required="">
                                    <option value="">--</option>
                                    @foreach($upazilas as $upazila)
                                        <option value="{{$upazila->id}}" {{$form->upazila->id == $upazila->id  ? 'selected' : ''}}>{{$upazila->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 ">
                                <label for="">House/Street Address <span class="required">*</span> </label>
                                <input name="permenentAddress" value="{{$form->permenentAddress}}" placeholder="House/Street Address" type="text"
                                       class="form-control"
                                       required="">
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Post Office<span class="required">*</span> </label>
                                <input name="permenentAddressPostOffice" value="{{$form->permenentAddressPostOffice}}" placeholder="Post Office" type="text"
                                       class="form-control" required="">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="title">Current Address</div>
                            <div class="col-md-12">
                                <div class="checkbox ">
                                    <label><input class="sameAddress" type="checkbox" name="sameAddress" value="on"> Use
                                        Current Address as Permanent Address</label>
                                </div>
                            </div>

                            <div class="permenentAddress">

                                <div class="col-md-4 ">
                                    <label for=""> Division <span class="required">*</span></label>
                                    <select class="form-control division2" id="" required="">
                                        <option value="">---</option>
                                        @foreach($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 ">
                                    <label for=""> District <span class="required">*</span></label>
                                    <select class="form-control district2" id="" required="">
                                        <option value="">--</option>
                                    </select>
                                </div>

                                <div class="col-md-4 ">
                                    <label for="">Thana/Upazila/Area <span class="required">*</span></label>
                                    <select name="currentAddressThana" class="form-control upazila2" required="">
                                        <option value="">--</option>
                                    </select>

                                </div>

                                <div class="col-md-4 ">
                                    <label for="">House/Street Address <span class="required">*</span> </label>
                                    <input name="currentAddress" type="text" placeholder="House/Street Address"
                                           class="form-control"
                                           required="">
                                </div>
                                <div class="col-md-4 ">
                                    <label for="">Post Office<span class="required">*</span> </label>
                                    <input name="currentAddressPostOffice" placeholder="Post Office" type="text"
                                           class="form-control" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="title">Educational Qualifications</div>
                    <br>

                        <div class="form-group ">
                            <div class="title">Educational Qualification 1</div>

                            <div class="col-md-4 ">
                                <label for=""> Education Level: <span class="required">*</span> </label>
                                <select class="form-control" id="" name="e1EL">
                                    <option value="">--</option>
                                    @foreach($concentrations as $con)
                                        @if($con->flag==1)
                                            <option value="{{ $con->name}}" {{($form->pito == $con->name) ? 'selected' : '' }}>{{$con->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 ">
                                <label for=""> Board: <span class="required">*</span> </label>
                                <select class="form-control" name="e1BD">
                                    <option value="">--</option>
                                    @foreach($eduBoards as $eduBoard)
                                        <option value="{{ $eduBoard->name}}" {{($form->poootao == $eduBoard->name) ? 'selected' : '' }}>{{$eduBoard->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for=""> Concentration: <span class="required">*</span> </label>
                                <select class="form-control" name="e1CON">
                                    <option value="">--</option>
                                    @foreach($playerLebels as $con)
                                        <option value="{{ $con->name}}" {{($form->APss == $con->name) ? 'selected' : '' }}>{{$con->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 ">
                                <label for="">Institution:<span class="required">*</span> </label>
                                <input name="e1INS" value="{{$form->APpos}}" type="text" class="form-control"
                                >
                            </div>
                            <div class="col-md-4 ">
                                <label for=""> Passing Year: <span class="required">*</span> </label>
                                <select class="form-control" id="" name="e1PY">

                                    <option value="">--</option>
                                    @foreach  (range( $latest_year, $earliest_year ) as $i )
                                        <option value="{{$i}}"{{$i == $form->ponum ? 'selected="selected"' : ''}}>{{$i}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Result:<span class="required">*</span> </label>
                                <input name="e1R" value="{{$form->APname}}" type="text"
                                       class="form-control"
                                >
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="title">Educational Qualification 2</div>

                            <div class="col-md-4 ">
                                <label for=""> Education Level: <span class="required">*</span> </label>
                                <select name="e2EL" class="form-control" id="">
                                    <option value="">--</option>
                                    @foreach($concentrations as $con)
                                        @if($con->flag==2)
                                            <option value="{{ $con->name}}" {{($form->e2EL == $con->name) ? 'selected' : '' }}>{{$con->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 ">
                                <label for=""> Board: <span class="required">*</span> </label>
                                <select name="e2BD" class="form-control">
                                    <option value="">--</option>
                                    @foreach($eduBoards as $eduBoard)
                                        <option value="{{ $eduBoard->name}}" {{($form->e2BD == $eduBoard->name) ? 'selected' : '' }}>{{$eduBoard->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-4">
                                <label for=""> Concentration: <span class="required">*</span> </label>
                                <select class="form-control" name="e2CON">
                                    <option value="">--</option>
                                    @foreach($playerLebels as $con)
                                        <option value="{{ $con->name}}" {{($form->e2CON == $con->name) ? 'selected' : '' }}>{{$con->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 ">
                                <label for="">Institution:<span class="required">*</span> </label>
                                <input name="e2INS" value="{{$form->e2INS}}" type="text" class="form-control"
                                >
                            </div>
                            <div class="col-md-4 ">
                                <label for=""> Passing Year: <span class="required">*</span> </label>
                                <select name="e2PY" class="form-control" id="">
                                    <option value="">--</option>
                                    @foreach  (range( $latest_year, $earliest_year ) as $i )
                                        <option value="{{$i}}"{{$i == $form->e2PY ? 'selected="selected"' : ''}}>{{$i}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Result:<span class="required">*</span> </label>
                                <input name="e2R" value="{{$form->e2PY}}" type="text"
                                       class="form-control"
                                >
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="title">Educational Qualification 3</div>

                            <div class="col-md-4 ">
                                <label for=""> Education Level: <span class="required">*</span> </label>
                                <select name="e3EL" class="form-control" id="">
                                    <option value="">--</option>
                                    @foreach($concentrations as $con)
                                        @if($con->flag==3)
                                            <option value="{{ $con->name}}" {{($form->e3EL == $con->name) ? 'selected' : '' }}>{{$con->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for=""> Subject: <span class="required">*</span> </label>
                                <input name="e3SJ" value="{{$form->e3EL}}" type="text"
                                       class="form-control"
                                >
                            </div>
                            <div class="col-md-4 ">
                                <label for=""> Institution: <span class="required">*</span> </label>
                                <select name="e3INS" class="form-control">
                                    <option value="">--</option>
                                    @foreach($uniLists as $university)
                                            <option value="{{ $university->name}}" {{($form->e3INS == $university->name) ? 'selected' : '' }}>{{$university->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 ">
                                <label for=""> Passing Year: <span class="required">*</span> </label>
                                <select name="e3PY" class="form-control  " id="">
                                    <option value="">--</option>
                                    <option value="">--</option>
                                    @foreach  (range( $latest_year, $earliest_year ) as $i )
                                        <option value="{{$i}}"{{$i == $form->e3PY ? 'selected="selected"' : ''}}>{{$i}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Result:<span class="required">*</span> </label>
                                <input name="e3R" value="{{$form->e3R}}" type="text"
                                       class="form-control"
                                >
                            </div>
                        </div>
                   {{-- @endif
                    @if($job->postGrad==1)--}}
                        <div class="form-group ">
                            <div class="title">Educational Qualification 4</div>

                            <div class="col-md-4 ">
                                <label for=""> Education Level: <span class="required">*</span> </label>
                                <select name="e4EL" class="form-control" id="">
                                    <option value="">--</option>
                                    @foreach($concentrations as $con)
                                        @if($con->flag==4)
                                            <option value="{{ $con->name}}" {{($form->photo10 == $con->name) ? 'selected' : '' }}>{{$con->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for=""> Subject: <span class="required">*</span> </label>
                                <input name="e4SJ" value="{{$form->OEGname}}" type="text"
                                       class="form-control">
                            </div>
                            <div class="col-md-4 ">
                                <label for=""> Institution: <span class="required">*</span> </label>
                                <select name="e4INS" class="form-control">
                                    <option value="">--</option>
                                    @foreach($uniLists as $university)
                                        <option value="{{ $university->name}}" {{($form->NOHname == $university->name) ? 'selected' : '' }}>{{$university->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 ">
                                <label for=""> Passing Year: <span class="required">*</span> </label>
                                <select name="e4PY" class="form-control  " id="">
                                    <option value="">--</option>
                                    @foreach  (range( $latest_year, $earliest_year ) as $i )
                                        <option value="{{$i}}"{{$i == $form->PITO2 ? 'selected="selected"' : ''}}>{{$i}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Result:<span class="required">*</span> </label>
                                <input name="e4R" value="{{$form->mota}}" type="text"
                                       class="form-control"
                                >
                            </div>
                        </div>
                </div>

                <div class="form-group ">
                    <div class="row">
                        <div class="title">Documents Required for Enlistment</div>
                        {{--                    <div class="col-md-3">
                                                <label for=""> আবেদনকারীর ছবি (সংযুক্ত করুন)<span class="required">*</span> </label>
                                                <div style="padding: 0" class="dropzone dropzoneFileUpload" id="photo">
                                                    <div class="dz-message">
                                                        <i class="fa fa-picture-o fa-5x" aria-hidden="true" required=""></i>
                                                    </div>
                                                </div>
                                            </div>--}}
                        <div class="col-md-6">
                            <label for="">Photo<span
                                        class="required">*</span> </label>
                            <div style="padding: 0" class="dropzone dropzoneFileUpload" id="photo2">
                                <div class="dz-message">
                                    <i class="fa fa-picture-o fa-5x" aria-hidden="true" required=""></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Signature<span
                                        class="required">*</span> </label>
                            <div style="padding: 0" class="dropzone dropzoneFileUpload" id="photo3">
                                <div class="dz-message">
                                    <i class="fa fa-picture-o fa-5x" aria-hidden="true" required=""></i>
                                </div>
                            </div>
                        </div>

                        {{--                    <div class="col-md-4">
                                                <label for="">Attested copy of Trade licence (Original to be shown)
                                                    <span class="required">Must in PDF/DOC format</span> </label>
                                                <input name="att1" placeholder=" Legal status" type="file" class="form-control"
                                                >
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Attested copy of Exporter's Registration certificate<span class="required">Must in PDF/DOC format</span></label>
                                                <input name="att2" placeholder=" Legal status" type="file" class="form-control"
                                                >
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Bank gurantee for Tk.2.00(TWO) lac in 300.00 tk. Stamp<span class="required">Must in PDF/DOC format</span></label>
                                                <input name="att3" placeholder=" Legal status" type="file" class="form-control"
                                                >
                                            </div>--}}
                    </div>
                    <br>
                </div>


            {{--Edit-Section End--}}








            <div class="form-group dead_man_info" style="display: none;">
                <div class="title">Attach More Documents for Renewal</div>

                <div class="dethInfo">
                    <div class="col-md-6">
                        <label for=""> The Receipt copy of your application and attached copy of chalan<span
                                    class="required">*</span> </label>
                        <div style="padding: 0" class="dropzone dropzoneFileUpload" id="photo9">
                            <div class="dz-message">
                                <i class="fa fa-picture-o fa-5x" aria-hidden="true" required=""></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for=""> Business settlement of final year with BJMC (Only Enlisted Buyer)<span
                                    class="required">*</span> </label>
                        <div style="padding: 0" class="dropzone dropzoneFileUpload" id="photo10">
                            <div class="dz-message">
                                <i class="fa fa-picture-o fa-5x" aria-hidden="true" required=""></i>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            @if ($form->PresentUpazila->id==$form->upazila->id)
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.sameAddress').trigger('click');
                    });
                </script>
            @endif
            @if (($form->photo9)!=NULL)
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.extra').trigger('click');
                    });
                </script>
            @endif

            <input type="submit" value="Update" class="btn btn-success pull-right">
        </form>
    </div>

    <script>
        $('#title').html("<b>Application form for Enlistment with BJMC as a Local Buyer of Jute Goods</b>");
    </script>
    <script>


        function nidCheck() {
            var nid = $.trim($('#nid').val());
            var ci_csrf_token = $("input[name='ci_csrf_token']").val();

            if (nid == "") {
                $("#checkNID").hide();
            }
            var targetUrl = "nid-duplicate-checking";
            var sendData = {
                nid: nid,
                ci_csrf_token: ci_csrf_token
            };

            $.get(targetUrl, sendData).done(function (data) {

                if (parseInt(data) == 1) {
                    $("#checkNID").show();
                } else {
                    $("#checkNID").hide();
                }
            }, "json");
        }


        (function ($) {
            $.fn.animateProgress = function (progress, callback) {
                return this.each(function () {
                    $(this).animate({
                        width: progress + '%'
                    }, {
                        duration: 2000,

                        easing: 'swing',

                        step: function (progress) {
                            var labelEl = $('.ui-label', this);

                            if (progress >= 7 && labelEl.is(':hidden')) {
                                labelEl.html('').fadeIn();
                            }
                            ;

                            if (Math.ceil(progress) == 100) {
                                labelEl.html('Done');
                                setTimeout(function () {
                                    labelEl.fadeOut();
                                }, 1000);
                            } else if (progress >= 10) {
                                labelEl.html('Processing <b>' + Math.ceil(progress) + '%</b>');
                            }
                        },
                        complete: function (scope, i, elem) {
                            if (callback) {
                                callback.call(this, i, elem);
                            }
                            ;
                        }
                    });
                });
            };
        })(jQuery);

        $(function () {
            $('#progress_bar').hide();
            $('.submitForm').click(function () {
                $('#main_content').hide();
                $('#progress_bar').show();
                $('#progress_bar .ui-progress').css('width', '7%').animateProgress(43, function () {
                    $(this).animateProgress(79, function () {
                        setTimeout(function () {
                            $('#progress_bar .ui-progress').animateProgress(100, function () {
                                $('#progress_bar').hide();
                                $('#main_content').slideDown();
                            });
                        }, 2000);
                    });
                });
            });
        });
    </script>

    <script type="text/javascript">
        var baseUrl = "{{ url('/') }}";
        Dropzone.autoDiscover = false;
        var config = {
            url: "/photo/upload",
            autoProcessQueue: true,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            maxFilesize: 5,
            acceptedFiles: 'image/*',
            addRemoveLinks: false,
            sending: function (file, xhr, formData) {
                formData.append("_token", _token);
                formData.append("type", this.element.id);
            }
        };
        var dzUploadPhoto2 = $("div#photo2").dropzone(config);
        var dzUploadPhoto3 = $("div#photo3").dropzone(config);
        var dzUploadPhoto4 = $("div#photo4").dropzone(config);
        var dzUploadPhoto5 = $("div#photo5").dropzone(config);
        var dzUploadPhoto6 = $("div#photo6").dropzone(config);
        var dzUploadPhoto7 = $("div#photo7").dropzone(config);
        var dzUploadPhoto9 = $("div#photo9").dropzone(config);
        var dzUploadPhoto10 = $("div#photo10").dropzone(config);
        var dzUploadcertificate = $("div#certificate").dropzone(config);
        if ($("div#death_certificate")) {
            var dzUploaddeath = $("div#death_certificate").dropzone(config);
        }

    </script>



@endsection