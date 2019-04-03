@extends('layouts.web')
@section('content')

    <style>
        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            padding: 4px 10px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }

        .header-name h3 {
            font-size: 20px;
            margin-top: 4px;
            font-style: oblique;
        }

        .singnature span {
            border-top: 1px dotted #ede;
            padding: 7px 15px;
        }

        .c-address address {
            border-top: 5px solid #ddd;
            border-bottom: 5px solid #ddd;
            padding: 10px 20px;
        }


        fieldset {
            border: 3px solid #ddd !important;
            margin: 0;
            min-width: 0;
            padding: 5px;
            position: relative;
            border-radius: 4px;
            padding-left: 10px !important;
        }

        legend {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 0px;
            width: auto;
            border: 3px solid #ddd;
            border-radius: 4px;
            padding: 5px 5px 5px 10px;
            background-color: #ffffff;
            display: inline-block;
        }
    </style>
    <div class="text-center"></div>
    <div class="col-md-12 c-wrapper white">
        <span class="btn btn-success btn-md pull-right printForm">Print</span>
        @if($form->status == 0)
            <div class="form-progress center">
                <ul class="nav nav-wizard center" style="width: 100%; margin: 0 auto">
                    <li class="active"><a href="javascript:">@lang('application.Submited')</a></li>
                    @if($form->is_delete == 0)
                        <li class="active"><a href="javascript:">@lang('application.Waiting for dc')</a></li>
                    @elseif($form->is_delete == 1)
                        <li class="active"><a href="javascript:">@lang('application.Permit for dc')</a></li>
                    @endif
                    @if($form->is_delete == 0)
                        <li><a href="javascript:">@lang('application.Checking')</a></li>
                    @elseif($form->is_delete == 1)
                        <li class="active"><a href="javascript:">@lang('application.Rejected')</a></li>
                    @endif
                </ul>
            </div>
        @elseif($form->status == 1)
            <div class="form-progress center">
                <ul class="nav nav-wizard center" style="width: 100%; margin: 0 auto">
                    <li class="active"><a href="javascript:">@lang('application.Submited')</a></li>
                    <li class="active"><a href="javascript:">@lang('application.Permit for dc')</a></li>
                    <li class="active"><a href="javascript:">@lang('application.Ministry')</a></li>
                    <li><a href="javascript:">@lang('application.Checking')</a></li>
                </ul>
            </div>
        @elseif($form->status == 3)
            <div class="form-progress center">
                <ul class="nav nav-wizard center" style="width: 100%; margin: 0 auto">
                    <li class="active"><a href="javascript:">@lang('application.Submited')</a></li>
                    <li class="active"><a href="javascript:">@lang('application.Permit for dc')</a></li>
                    <li class="active"><a href="javascript:">@lang('application.Ministry')</a></li>
                    <li class="active"><a href="javascript:">@lang('application.dc_approve_mi')</a></li>
                </ul>
            </div>
        @elseif($form->status == 2)
            <div class="form-progress center">
                <ul class="nav nav-wizard center" style="width: 100%; margin: 0 auto">
                    <li class="active"><a href="javascript:">@lang('application.Submited')</a></li>
                    <li class="active"><a href="javascript:">@lang('application.Permit for dc')</a></li>
                    <li class="active"><a href="javascript:">@lang('application.dc_bkkf')</a></li>
                    <li><a href="javascript:">@lang('application.Checking')</a></li>
                </ul>
            </div>
        @elseif($form->status == 4)
            <div class="form-progress center">
                <ul class="nav nav-wizard center" style="width: 100%; margin: 0 auto">
                    <li class="active"><a href="javascript:">@lang('application.Submited')</a></li>
                    <li class="active"><a href="javascript:">@lang('application.Permit for dc')</a></li>
                    {{--<li class="active"><a href="javascript:">@lang('application.dc_bkkf')</a></li>--}}
                    <li class="active"><a href="javascript:">@lang('application.dc_approve_bk')</a></li>
                </ul>
            </div>
        @endif

        <div id="printable">

            <div class="col-md-12" style="margin-top: 20px;">

                <h4 style="width: 100%" align="center">Your application request has been received.
                    <br>Please, preserve your tracking number for next step.
                </h4>

                <p align="center">
                    <strong>Name</strong> {{$form->name}}
                    <br>
                    <strong>Tracking Number :</strong> {{$form->trackingNumber}}

                <div style="
    margin-top: 55px;
    width: 100%;">
                    <!-- <hr> -->
                </div>
            </div>
            @if($form->checkStatus==1)
            <div class="col-md-12" style=" margin-top: 2px; margin-bottom: 3px;">
                <h4 class=" alert alert-danger" style="" align="center">{{$form->message}}</h4>
                <p align="center"><button class="btn btn-outline-inverse"><a href="{{ route('application-form.edit',$form->id) }}">Click here</a></button> for Edit previous info and submit again.</p>
                <div style="
    margin-top: 5px;
    width: 100%;">
                    <!-- <hr> -->
                </div>
            </div>
@endif
            <div class="col-md-12">
                <div class="panel-body">
                    <fieldset class="col-md-12">
                        <legend>Particulars of the Applicant</legend>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 200px">Name:</th>
                                    <td colspan="3" style="width: 240px">{{$form->name}}</td>

                                </tr>
                                <tr>
                                    <th style="width: 200px">Father Name:</th>
                                    <td style="width: 240px">{{$form->fatherName}}</td>
                                    <th style="width: 200px">Mother Name:</th>
                                    <td style="width: 240px">{{$form->motherName}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Mobile No:</th>
                                    <td style="width: 240px">{{$form->mobile}}</td>
                                    <th style="width: 200px">Email:</th>
                                    <td style="width: 240px">{{$form->designation}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Religion:</th>
                                    <td style="width: 240px">{{$form->profession}}</td>
                                    <th style="width: 200px">Gender</th>
                                    <td style="width: 240px">{{$form->annualIncome}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Marital Status:</th>
                                    <td style="width: 240px">{{$form->bname}}</td>
                                    <th style="width: 200px">Blood Group:</th>
                                    <td style="width: 240px">{{$form->poootao}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Nationality:</th>
                                    <td style="width: 240px">{{$form->country}}</td>
                                    <th style="width: 200px">NID:</th>
                                    <td style="width: 240px">{{toEnglish($form->NID)}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Date of Birth:</th>
                                    <td style="width: 240px">{{toEnglish($form->birth)}}</td>
                                    <th style="width: 200px">Quota:</th>
                                    <td style="width: 240px">{{$form->bankAccNo}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Departmental Candidate Status:</th>
                                    <td style="width: 240px">{{$form->bankName}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>

                <div class="panel-body">
                    <fieldset class="col-md-12">
                        <legend>Address Information</legend>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th colspan="2" style="text-align: center; width: 440px">Permanent Address</th>
                                    <th colspan="2" style="text-align: center; width: 440px">Present Address</th>

                                </tr>
                                <tr>
                                    <th style="width: 200px">House: / Village:</th>
                                    <td style="width: 240px">{{$form->permenentAddress}}</td>
                                    <th style="width: 200px">House: / Village:</th>
                                    <td style="width: 240px">{{$form->currentAddress}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Post Office:</th>
                                    <td style="width: 240px">{{$form->permenentAddressPostOffice}}</td>
                                    <th style="width: 200px">Post Office:</th>
                                    <td style="width: 240px">{{$form->currentAddressPostOffice}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">Thana/Upazila/Area :</th>
                                    <td style="width: 240px">{{$form->Upazila->name}}</td>
                                    <th style="width: 200px">Thana/Upazila/Area :</th>
                                    <td style="width: 240px">{{$form->PresentUpazila->name}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 200px">District :</th>
                                    <td style="width: 240px">{{$form->upazila->district->name}}</td>
                                    <th style="width: 200px">District :</th>
                                    <td style="width: 240px">{{$form->PresentUpazila->district->name}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>

                <br><br><br><br>
                <div class="panel-body">
                    <fieldset class="col-md-12">
                        <legend>Academic Qualifications:</legend>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="text-align: center; width: 16%">Education Level</th>
                                    <th style="text-align: center; width: 16%">Board</th>
                                    <th style=" text-align: center;width: 20%">Department</th>
                                    <th style="text-align: center; width: 24%">Institution</th>
                                    <th style="text-align: center;width: 12%">Passing Year</th>
                                    <th style="text-align: center; width: 12%">Result</th>
                                </tr>
                                @if($form->pito!=NULL)
                                    <tr>
                                        <td style="text-align: center; width: 16%">{{$form->pito}}</td>
                                        <td style="text-align: center; width: 16%">{{$form->poootao}}</td>
                                        <td style=" text-align: center;width: 20%">{{$form->APss}}</td>
                                        <td style="text-align: center; width: 24%">{{$form->APpos}}</td>
                                        <td style="text-align: center;width: 12%">{{$form->ponum}}</td>
                                        <td style="text-align: center; width: 12%">{{$form->APname}}</td>
                                    </tr>
                                @endif
                                @if($form->e2EL!=NULL)
                                    <tr>
                                        <td style="text-align: center; width: 16%">{{$form->e2EL}}</td>
                                        <td style="text-align: center; width: 16%">{{$form->e2BD}}</td>
                                        <td style=" text-align: center;width: 20%">{{$form->e2CON}}</td>
                                        <td style="text-align: center; width: 24%">{{$form->e2INS}}</td>
                                        <td style="text-align: center;width: 12%">{{$form->e2PY}}</td>
                                        <td style="text-align: center; width: 12%">{{$form->e2R}}</td>
                                    </tr>
                                @endif
                                @if($form->e3EL!=NULL)
                                    <tr>
                                        <td style="text-align: center; width: 16%">{{$form->e3EL}}</td>
                                        <td style="text-align: center; width: 16%"></td>
                                        <td style=" text-align: center;width: 20%">{{$form->e3SJ}}</td>
                                        <td style="text-align: center; width: 24%">{{$form->e3INS}}</td>
                                        <td style="text-align: center;width: 12%">{{$form->e3PY}}</td>
                                        <td style="text-align: center; width: 12%">{{$form->e3R}}</td>
                                    </tr>
                                @endif
                                @if($form->photo10!=NULL)
                                    <tr>
                                        <td style="text-align: center; width: 16%">{{$form->photo10}}</td>
                                        <td style="text-align: center; width: 16%"></td>
                                        <td style=" text-align: center;width: 20%">{{$form->OEGname}}</td>
                                        <td style="text-align: center; width: 24%">{{$form->NOHname}}</td>
                                        <td style="text-align: center;width: 12%">{{$form->PITO2}}</td>
                                        <td style="text-align: center; width: 12%">{{$form->mota}}</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
{{--                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 300px">
                                        <legend>Permanent Address</legend>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 200px">House/Street Address</th>
                                    <td style="width: 240px">{{$form->permenentAddress}}</td>
                                    <th style="width: 200px">Post Office</th>
                                    <td style="width: 240px">{{$form->permenentAddressPostOffice}}</td>
                                </tr>
                                <tr>
                                    <th>Thana/Upazila/Area</th>
                                    <td>{{$form->upazila->name}}</td>
                                    <th>District</th>
                                    <td>{{$form->upazila->district->name}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 300px">
                                        <legend>Current Address</legend>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 200px">House/Street Address</th>
                                    <td style="width: 240px">{{$form->currentAddress}}</td>
                                    <th style="width: 200px">Post Office</th>
                                    <td style="width: 240px">{{$form->currentAddressPostOffice}}</td>
                                </tr>
                                <tr>
                                    <th>Thana/Upazila/Area</th>
                                    <td>{{$form->PresentUpazila->name}}</td>
                                    <th>District</th>
                                    <td>{{$form->PresentUpazila->district->name}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>--}}
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('body').on('click', '.printForm', function () {

                var newWin = window.open('', 'PRINT');
                var content = '<html> <link rel=\"stylesheet\" href=\"/bower_components/bootstrap/dist/css/bootstrap.min.css\"> <body onload="window.print()"><style>.signature{visibility: visible!important;}</style>' + printable.innerHTML + '</body></html>';
                // var newWin=window.open('','Print');
                newWin.document.open();
                newWin.document.write(content);

                newWin.document.close(); // necessary for IE >= 10
                setTimeout(function () {
                    newWin.focus(); // necessary for IE >= 10*/
                    newWin.print();
                    newWin.close();
                }, 0);


            });
        })
    </script>
    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>

@endSection
