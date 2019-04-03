@extends('layouts.web')
@section('content')

    <div class="panel panel-default homePage">

        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    @if(Auth::user()->hasRole(['dc', 'bsc', 'ministry']))
                        <span style="margin-left:5px; margin-top: 22px; text-align: center;">
                            <h2>
                                <b>Welcome @if(Auth::user()->username == 'ministry')
                                        Super Admin
                                    @elseif(Auth::user()->username == 'bkkf')
                                        Super Admin
                                    @endif
                                    @if(Auth::user()->locationable_type == 'App\District')
                                       Admin
                                    @endif
                                    ! Your Dashboard Panel
                                </b>
                            </h2>
                            <h4><a href="/admin" class="btn btn-success btn-lg">Click here for admin panel </a></h4>
                        </span>
                    @else
                        <h4 style="margin-left:5px; margin-top: 22px; text-align: center;"><b>Enlistment with BJMC as a Local Buyer of Jute Goods</b></h4>
                        <div class="widget">
                            <div class="alert alert-warning" style="text-align:left;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <strong><i class="fa fa-exclamation-triangle fa-lg fa-2x" aria-hidden="true"></i>
                                    Application form
                                    Instructions:</strong><br><br>
                                <ul style="text-align:left; font-size:15px;">
                                    <li>Read instructions carefully before filling up form.</li>
                                    <li>Fill up the the form carefully
                                    </li>
                                    <li>If there any wrong information found your application will be rejected
                                    </li>
                                    <li>Legal action will be taken for Wrong/False information</li>
                                </ul>
                            </div>
                            <br>
                            <div class="alert alert-info info_success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <strong><i class="fa fa-book fa-lg fa-2x" aria-hidden="true"></i> Must Required Documents for New Applicant </strong><br><br>
                                <ul>
                                    <li>NID Number / Birth Certificate Number<span class="required">(.jpg format / Scan Copy)</span></li>
                                    <li>Prescribed From of BJMC duly filled in, scaled and signed by propitor/MD
                                        <span class="required">(.jpg format/ Scan Copy)</span></li>
                                    <li>Attested copy of jute goods exporter's license (Original to be Shown)
                                        <span class="required">(.jpg format / Scan Copy)</span></li>
                                    <li>Attested copy of Income Tax certificate (Original to be Shown)
                                        <span class="required">(.jpg format / Scan Copy)</span></li>
                                    <li>Bank Solvency Certificate <span class="required">(.jpg format / Scan Copy)</span></li>
                                    <li>Attested copy of jute goods exporter's association (BJMC) Membership
                                        certificate<span class="required">(.jpg format / Scan Copy)</span></li>
                                    <li>Copy of Enlistment fee of Tk. 3000.00 (Three Thousand) shall have to be deposited in BJMC
                                     cash section <span class="required">(.jpg format / Scan Copy)</span></li>
                                    <li>Attested copy of Trade licence (Original to be shown)<span class="required">(.PDF format)</span> Approximately 7-8 page</li>
                                    <li>Attested copy of Exporter's Registration certificate (E.R.C). <span class="required">(.PDF format)</span>
                                        Approximately 7-8 page</li>
                                    <li>Bank guarantee for Tk.2.00(TWO) lac with minimum Extension of validity in 300.00 tk. Stamp.
                                        <span class="required">(.PDF format)</span> 3 page</li>
                                    <br>
                                    <strong><i class="fas fa-file-contract fa-lg" aria-hidden="true"></i>With Above documents, Must Required Documents for Renewal Applicant </strong>
                                    <li> The Receipt copy of your application and attached copy of chalan<span class="required">(.jpg format / Scan Copy)</span></li>
                                    <li>Business settlement of final year with BJMC (Only Enlisted Buyer)<span class="required">(.jpg format / Scan Copy)</span></li>
                                </ul>
                            </div>
                            <br><br>
                            <h4 style="text-align: center">
                                <a href="{{ url('/application-form') }}" class="btn btn-success btn-lg">Apply</a>
                            </h4>
                        </div>
                    @endif
                @else
                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div class="col-md-12 c-wrapper">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Tracking Number</th>
                                        <th>Job Name</th>
                                        <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($availableJobs as $key => $aJobs)
                                        <tr>
                                            <th>{{$aJobs->trackingID}}</th>
                                            <th>{{$aJobs->name}}</th>
                                            <th>{{$aJobs->job_deadline}}</th>
                                            <th><a href="{{URL::to('available-jobs/'.$aJobs->id)}}"><i class='btn btn-info btn-sm'>Apply</i> </a></th>

                                    @endforeach
                                    </tbody>

                                </table>
                            </div>


                           {{-- <div class="col-md-12 home_content">
                                <h3>Instruction for online Application</h3>
                                <ul class="list-unstyled">
                                    <li><span><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;</span>
                                        You have to Register first for application.
                                    </li>
                                    <li><span><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;</span>Create new account for Registration <a href="{{ url('/register') }}">Click here</a>.
                                    </li>

                                    <li><span><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;</span>After login click on apply.
                                    </li>
                                    <li><span><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;</span>A visual informative
                                        form will appear, fill up with proper information and submit.
                                    </li>

                                    <li><span><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;</span>Please, preserve tracking number for next update.
                                    </li>
                                </ul>
                            </div>--}}
                        </div>
                    </div>
                @endauth
            </div>
        @endif
    </div>
@endsection