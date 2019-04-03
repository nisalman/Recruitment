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
                    <button type="button" class="btn btn-success submitForm">@lang('Submit')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12" id="application-form">
        <form class="form-horizontal app-form se-form" data-name="app-form" method="post" enctype="multipart/form-data"
              autocomplete="off">


            <div class="col-md-12 text-center">
                @include('msg')
                <div style="color: red;"><b style="color: black;">NB: &nbsp;&nbsp;</b>Red Marked(*) Files are mandatory.
                </div>
            </div>


        {{csrf_field()}}

            <input type="hidden" name="year_id" value="{{$year_id}}">
            <div id="loading2" style="display:none;"><img src="{{ asset('images') }}/loading.gif" alt=""/></div>

            <div class="form-group">
                <div class="title">General Info</div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Applicant Name<span class="required">*</span> </label>
                        <input name="name" placeholder="Write Full Name" type="text" class="form-control">
                        <input name="appliedPosition" type="hidden" value="{{$job->id}}">
                        <input name="job_id" type="hidden" value="{{$job->id}}">
                    </div>
                </div>
                <div class="row">
                    <div class=" col-md-6">
                        <label for="">Father's Name<span class="required">*</span></label>
                        <input name="fatherName" placeholder="Father's Name" type="text"
                               class="form-control">
                    </div>
                    <div class=" col-md-6">
                        <label for="">Mother's Name<span class="required">*</span></label>
                        <input name="motherName" placeholder="Mother's Name" type="text" class="form-control"
                        >
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="">Mobile Number<span class="required">*</span></label>
                        <input name="mobile" type="text" placeholder="11 Digit Mobile Number" value="{{$user->mobile}}"
                               class="form-control">
                    </div>
                    <div class=" col-md-4">
                        <label for="">Email <span class="required">*</span> </label>
                        <input name="designation" type="text" placeholder="example@mail.com"
                               class="form-control">
                    </div>

                    <div class=" col-md-4">

                        <label for="">Religion<span class="required">*</span> </label>
                        <select name="profession" id="" class="form-control">
                            <option> ---</option>
                            @foreach($religions as $religion)
                                <option value="{{$religion->name}}"> {{$religion->name}} </option>
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
                                <option value="{{$gender->name}}"> {{$gender->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-md-4">
                        <label for="">Maritial Status</label>
                        <select name="bname" id="" class="form-control">
                            <option> ---</option>
                            @foreach($Marital_Status as $ms)
                                <option value="{{$ms->name}}"> {{$ms->name}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class=" col-md-4">
                        <label for="">Blood Group</label>
                        <select name="playerType" id="" class="form-control">
                            <option> ---</option>
                            @foreach($BloodGroups as $BloodGroup)
                                <option value="{{$BloodGroup->name}}"> {{$BloodGroup->name}} </option>
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
                        <input name="NID" id="nid" type="text" placeholder="National ID Number"
                               class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="">Date of Birth <span class="required">*</span> </label>
                        <input name="birth" type="text" placeholder="Date of Birth "
                               class="form-control datepicker">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Quota<span class="required">*</span> </label>
                        <select name="quota" class="form-control" required="">
                            <option value="">---</option>
                            @foreach($designations as $quota)
                                <option value="{{$quota->name}}">{{$quota->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">Departmental Candidate Status<span class="required">*</span> </label>
                        <select name="deptCan" class="form-control" required="">
                            <option value="">---</option>
                            @foreach($professions as $deptCan)
                                <option value="{{$deptCan->name}}">{{$deptCan->name}}</option>
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
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 ">
                            <label for=""> District <span class="required">*</span> </label>
                            <select class="form-control district" id="" required="">
                                <option value="">--</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Thana/Upazila/Area <span class="required">*</span> </label>
                            <select name="permenentAddressThana" class="form-control upazila" required="">
                                <option value="">--</option>
                            </select>
                        </div>

                        <div class="col-md-4 ">
                            <label for="">House/Street Address <span class="required">*</span> </label>
                            <input name="permenentAddress" placeholder="House/Street Address" type="text"
                                   class="form-control"
                                   required="">
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Post Office<span class="required">*</span> </label>
                            <input name="permenentAddressPostOffice" placeholder="Post Office" type="text"
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
                @if($job->ssc==1)
                    <div class="form-group ">
                        <div class="title">Educational Qualification 1</div>

                        <div class="col-md-4 ">
                            <label for=""> Education Level: <span class="required">*</span> </label>
                            <select class="form-control" id="" name="e1EL">
                                <option value="">--</option>
                                @foreach($concentrations as $con)
                                    @if($con->flag==1)
                                        <option value="{{$con->name}}">{{$con->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 ">
                            <label for=""> Board: <span class="required">*</span> </label>
                            <select class="form-control" name="e1BD">
                                <option value="">--</option>
                                @foreach($eduBoards as $eduBoard)
                                    <option value="{{$eduBoard->name}}">{{$eduBoard->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Concentration: <span class="required">*</span> </label>
                            <select class="form-control" name="e1CON">
                                <option value="">--</option>
                                @foreach($playerLebels as $con)
                                    <option value="{{$con->name}}">{{$con->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 ">
                            <label for="">Institution:<span class="required">*</span> </label>
                            <input name="e1INS" placeholder="Name of Institution" type="text" class="form-control"
                            >
                        </div>
                        <div class="col-md-4 ">
                            <label for=""> Passing Year: <span class="required">*</span> </label>
                            <select class="form-control" id="" name="e1PY">
                                <option value="">--</option>
                                @foreach  (range( $latest_year, $earliest_year ) as $i )
                                    <option value="{{$i}}{{$i === $currently_selected ? ' selected="selected"' : ''}}">{{$i}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Result:<span class="required">*</span> </label>
                            <input name="e1R" placeholder="Result" type="text"
                                   class="form-control"
                            >
                        </div>
                    </div>
                @endif
                @if($job->hsc==1)
                    <div class="form-group ">
                        <div class="title">Educational Qualification 2</div>

                        <div class="col-md-4 ">
                            <label for=""> Education Level: <span class="required">*</span> </label>
                            <select name="e2EL" class="form-control" id="">
                                <option value="">--</option>
                                @foreach($concentrations as $con)
                                    @if($con->flag==2)
                                        <option value="{{$con->name}}">{{$con->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 ">
                            <label for=""> Board: <span class="required">*</span> </label>
                            <select name="e2BD" class="form-control">
                                <option value="">--</option>
                                @foreach($eduBoards as $eduBoard)
                                    <option value="{{$eduBoard->name}}">{{$eduBoard->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-4">
                            <label for=""> Concentration: <span class="required">*</span> </label>
                            <select class="form-control" name="e2CON">
                                <option value="">--</option>
                                @foreach($playerLebels as $con)
                                    <option value="{{$con->name}}">{{$con->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 ">
                            <label for="">Institution:<span class="required">*</span> </label>
                            <input name="e2INS" placeholder="Name of Institution" type="text" class="form-control"
                            >
                        </div>
                        <div class="col-md-4 ">
                            <label for=""> Passing Year: <span class="required">*</span> </label>
                            <select name="e2PY" class="form-control" id="">
                                <option value="">--</option>
                                @foreach  (range( $latest_year, $earliest_year ) as $i )
                                    <option value="{{$i}}{{$i === $currently_selected ? ' selected="selected"' : ''}}">{{$i}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Result:<span class="required">*</span> </label>
                            <input name="e2R" placeholder="Result" type="text"
                                   class="form-control"
                            >
                        </div>
                    </div>
                @endif
                {{--                    @php
                                    dd($job);
                                    @endphp--}}
                @if($job->grad==1)
                    <div class="form-group ">
                        <div class="title">Educational Qualification 3</div>

                        <div class="col-md-4 ">
                            <label for=""> Education Level: <span class="required">*</span> </label>
                            <select name="e3EL" class="form-control" id="">
                                <option value="">--</option>
                                @foreach($concentrations as $con)
                                    @if($con->flag==3)
                                        <option value="{{$con->name}}">{{$con->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for=""> Subject: <span class="required">*</span> </label>
                            <input name="e3SJ" placeholder="Subject" type="text"
                                   class="form-control"
                            >
                        </div>
                        <div class="col-md-4 ">
                            <label for=""> Institution: <span class="required">*</span> </label>
                            <select name="e3INS" class="form-control">
                                <option value="">--</option>
                                @foreach($uniLists as $university)
                                    <option value="{{$university->name}}">{{$university->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-4 ">
                            <label for=""> Passing Year: <span class="required">*</span> </label>
                            <select name="e3PY" class="form-control  " id="">
                                <option value="">--</option>
                                @foreach  (range( $latest_year, $earliest_year ) as $i )
                                    <option value="{{$i}}{{$i === $currently_selected ? ' selected="selected"' : ''}}">{{$i}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Result:<span class="required">*</span> </label>
                            <input name="e3R" placeholder="Result" type="text"
                                   class="form-control"
                            >
                        </div>
                    </div>
                @endif
                @if($job->postGrad==1)
                    <div class="form-group ">
                        <div class="title">Educational Qualification 4</div>

                        <div class="col-md-4 ">
                            <label for=""> Education Level: <span class="required">*</span> </label>
                            <select name="e4EL" class="form-control" id="">
                                <option value="">--</option>
                                @foreach($concentrations as $con)
                                    @if($con->flag==4)
                                        <option value="{{$con->name}}">{{$con->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for=""> Subject: <span class="required">*</span> </label>
                            <input name="e4SJ" placeholder="Subject" type="text"
                                   class="form-control">
                        </div>
                        <div class="col-md-4 ">
                            <label for=""> Institution: <span class="required">*</span> </label>
                            <select name="e4INS" class="form-control">
                                <option value="">--</option>
                                @foreach($uniLists as $university)
                                    <option value="{{$university->name}}">{{$university->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-4 ">
                            <label for=""> Passing Year: <span class="required">*</span> </label>
                            <select name="e4PY" class="form-control  " id="">
                                <option value="">--</option>
                                @foreach  (range( $latest_year, $earliest_year ) as $i )
                                    <option value="{{$i}}{{$i === $currently_selected ? ' selected="selected"' : ''}}">{{$i}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Result:<span class="required">*</span> </label>
                            <input name="e4R" placeholder="Result" type="text"
                                   class="form-control"
                            >
                        </div>
                    </div>
            </div>
            @endif

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
                        <label for="">Photo: <span
                                    class="required"> &nbsp (Size must in {{$max->address}} KB)</span> </label>
                        <div style="padding: 0" class="dropzone dropzoneFileUpload photoValidation" id="photo2">
                            <div class="dz-message">
                                <i class="fa fa-picture-o fa-5x" aria-hidden="true" required=""></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Signature<span
                                    class="required">&nbsp (Size must in {{$signSize->address}} KB)</span> </label>
                        <div style="padding: 0" class="dropzone dropzoneFileUpload photoValidation" id="photo3">
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




    <input type="submit" value="Apply" class="btn btn-success pull-right">
    </form>
    </div>

    <script>
        $('#title').html("<b>Application form for The Post for {{$job->name}}</b>");
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
<script>

</script>
    <script type="text/javascript">
        var baseUrl = "{{ url('/') }}";
        maxsize = {!! json_encode($max->address) !!};
        signSize = {!! json_encode($signSize->address) !!};
        Dropzone.autoDiscover = false;
        var config = {
            url: "/photo/upload",
            autoProcessQueue: true,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            maxFilesize: maxsize,
            acceptedFiles: 'image/*',
            addRemoveLinks: false,
            sending: function (file, xhr, formData) {
               // console.log(this.element.id);
                formData.append("_token", _token);
                formData.append("type", this.element.id);
            }
        };
        var signConfig = {
            url: "/photo/upload",
            autoProcessQueue: true,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            maxFilesize: signSize,
            acceptedFiles: 'image/*',
            addRemoveLinks: false,
            sending: function (file, xhr, formData) {
                // console.log(this.element.id);
                formData.append("_token", _token);
                formData.append("type", this.element.id);
            }
        };

        var dzUploadPhoto2 = $("div#photo2").dropzone(config);
        var dzUploadPhoto3 = $("div#photo3").dropzone(signConfig);
        var dzUploadPhoto4 = $("div#photo4").dropzone(config);
        var dzUploadcertificate = $("div#certificate").dropzone(config);
        if ($("div#death_certificate")) {
            var dzUploaddeath = $("div#death_certificate").dropzone(config);
        }

    </script>

@endsection