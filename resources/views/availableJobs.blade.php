@extends('layouts.admin')
@section('content')
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
                    <th>{{(toBangla($aJobs->job_deadline))}}</th>
                    <th><a href="{{URL::to('available-jobs/'.$aJobs->id)}}"><i class='btn btn-info btn-sm'>আবেদন করুন</i> </a></th>

            @endforeach
            </tbody>

        </table>
    </div>




    @endsection