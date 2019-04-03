@extends('layouts.admin')
@section('content')
@role('dc')
<button type="button" class="btn btn-info pull-right selected-forms-btn" >@lang('Selected Forms')</button>
@endrole
<!-- Modal -->
<div id="fwmodal" class="modal fade " role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('Please select where to forward')</h4>
      </div>
<form data-name='fwform' id="fwform" method="post" >
      <div class="modal-body">
        {{--  --}}
  {{csrf_field()}}
  <input type="hidden" name="id" id="formid">
 <div style="text-align:left">To:<br><input id="ministry" class="fwradio" name="status" value="1" required type="radio" ><label for="ministry" class="fwradio">@lang('Ministry')</label>
    <input class="fwradio" type="radio" name="status" id="bkkf" value="2"  required><label class="fwradio" for="bkkf" >@lang('BKKF')</label><br>
    <br>Priority Order:<br><input type="number" class="form-control" name="rating" required>
  </div>

        {{--  --}}
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success">@lang("Submit")</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang("Close")</button>
      </div>
</form>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade " role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('Selected Forms')</h4>
      </div>
      <div class="modal-body">
          <button class="btn btn-info pull-right fwbtn">@lang('Forward')</button>
        {{--  --}}
        <div class="col-md-12">
          
        <table class="col-md-6" style="max-width: 400px">
          <thead style="min-height: 200px">
            <tr><th colspan="4">@lang('Ministry')</th></tr>
            <th>#</th>
            <th>@lang('Applicant Name')</th>
            <th>@lang('Priority Order')</th>
            <th></th>
          </thead>
          <tbody id="sortable" class="connectedSortable">
          </tbody>
        </table>
        <table class="col-md-6" style="max-width: 400px; float: right;">
          <thead>
            <tr><th colspan="4">@lang('BKKF')</th></tr>
            <th>#</th>
            <th>@lang('Applicant Name')</th>
            <th>@lang('Priority Order')</th>
            <th></th>
          </thead>
          <tbody id="sortable2" class="connectedSortable">
          </tbody>
        </table>
        </div>

        {{--  --}}
      </div>
        <script>
  $( function() {
    if ($( "#sortable, #sortable2 " ).length) {
        $("#sortable, #sortable2 ").sortable({
            placeholder: "ui-state-highlight",
            connectWith: ".connectedSortable",
            items: ">*:not(.sort-disabled)",
            update: function () {
                updatePosition();
            }
        });
    }
  });
  </script>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- sumary for dc -->
@role('dc')
<!-- 
  <div  class="se-form" >
  <div class="form-group" >
    <div class="title">@lang('Summary')</div>
    
    <div class="col-md-3 summary bg-green">
      
    </div>

  </div>
</form> -->

@endrole
<!-- sumary for dc -->


<!-- sumary for nsc -->

<!-- sumary for nsc -->


<!-- sumary for ministry/BSC -->

<!-- sumary for ministry/BSC -->


<div class="filter-container">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading bg-blue" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                        <span class="glyphicon glyphicon-search"></span> Advanced filter
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <form action="" class="form-horizontal se-form original dForm">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="">@lang('Tracking Number')</label>
                                <input type="text" name="trackingNumber" class="form-control" >
                            </div>

                            <div class="col-md-2 ">
                                <label for=""> @lang('Player Type')  </label>
                                <select name="to" id="" class="form-control">
                                    <option value="">--</option>
                                </select>
                            </div>

                            <div class="col-md-2 ">
                                <label for=""> @lang('Player Level')  </label>
                                <select name="to" id="" class="form-control">
                                    <option value="">--</option>
                                </select>
                            </div>

                            <div class="col-md-2 ">
                                <label for=""> @lang('Player Level')  </label>
                                <select name="to" id="" class="form-control">
                                    <option value="">--</option>
                                </select>
                            </div>
                            @role(['nsc', 'ministry', 'bsc'])
                            <div class="col-md-2">
                                <label for="">@lang('Division')</label>
                                <select  class="form-control division2" name="division">
                                    <option value="">---</option>
                                    @foreach(\App\Division::all() as $division)
                                        <option value="{{$division->id}}">{{$division->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for=""> @lang('District')  </label>
                                <select  class="form-control district2" name="district">
                                    <option  value="">--</option>
                                </select>
                            </div>
                            @role('nsc')

                            <div class="col-md-3 ">
                                <label for=""> @lang('Status')  </label>
                                <select name="status" id="" class="form-control">
                                    <option value="">--</option>
                                    <option value="null">@lang('Pending')</option>
                                    <option value="ministry">@lang('Forwarded to Ministry')</option>
                                    <option value="bsc">@lang('Forwarded to BSC')</option>
                                </select>
                            </div>

                            @endrole

                            @role(['ministry', 'bsc'])

                            <div class="col-md-2 ">
                                <label for=""> @lang('Status')  </label>
                                <select name="approval" id="" class="form-control">
                                    <option value="">--</option>
                                    <option value="null">@lang('Pending')</option>
                                    <option value="1">@lang('Accepted')</option>
                                    <option value="0">@lang('Rejected')</option>
                                </select>
                            </div>

                            @endrole



                            <div class="col-md-12">
                                <input type="submit" value="@lang('Filter')" class="btn btn-success pull-right">
                            </div>
                            @endrole

                        <!-- dc -->


                            @role('dc')
                            <div class="col-md-3 ">
                                <label for=""> @lang('Status')  </label>
                                <select name="status" id="" class="form-control">
                                    <option value="">--</option>
                                    <option value="null">@lang('Pending')</option>
                                    <option value="selected">@lang('Selected')</option>
                                    <option value="ministry">@lang('Forwarded to Ministry')</option>
                                    <option value="bsc">@lang('Forwarded to BKKF')</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <input type="submit" value="@lang('Filter')" class="btn btn-success pull-right">
                            </div>
                        @endrole


                        <!-- dc -->




                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 c-wrapper">

<table id="datatable" class="table table-striped table-bordered report-table">
    <thead>
    <tr>
        <th>#</th>
        <th>@lang('application.applicant_name')</th>
        <th>@lang('application.applicant_mobile')</th>
        <th>@lang('application.priority')</th>
        @role(['ministry','bsc'])
        <th>@lang('application.district_name')</th>
        @endrole
        <th>@lang('application.sports_name')</th>
        <th>@lang('application.sports_type')</th>
        <th>@lang('application.Annual Income')</th>
        <th>@lang('application.app_current_status')</th>
        <th>@lang('application.app_current_status')</th>
        <th style="text-align: center;width: 100px;">@lang('default.action')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($forms as $form)
    <tr>
        <td>{{ $form->id }}</td>
        <td>{{ $form->name }}</td>
        <td>{{ toBangla($form->mobile) }}</td>
        <td>{{ toBangla($form->rating) }}</td>
        <td>{{ $form->sport_name }}</td>
        <td>@if($form->player_name)
            {{ $form->player_name }}
            @else
            প্রযোজ্য নয়
                @endif
        </td>
        <td>{{ toBangla($form->annualIncome) }}</td>
        <td>
            @if(trim($form->status) == 1)
                <span class="label label-xs label-info">@lang('application.dc_ministry')</span>
            @elseif(trim($form->status) == 2)
                <span class="label label-xs label-success">@lang('application.dc_bkkf')</span>
            @elseif(trim($form->status) == 3)
                <span class="label label-xs label-primary">@lang('application.dc_approve_mi')</span>
            @elseif(trim($form->status) == 4)
                <span class="label label-xs label-primary">@lang('application.dc_approve_bk')</span>
            @else
                <span class="label label-sm label-warning">@lang('application.dc_pending')</span>
            @endif
        </td>
        <td>
            <a href="{{ route('form-submissions.edit', [$form->id]) }}"><i class='btn btn-default btn-sm fa fa-pencil'></i></a>
            <a href=""><i class='btn btn-danger btn-sm fa fa-trash'></i></a>
        </td>
    </tr>
        @endforeach
    </tbody>

</table>
</div>

<div >

<!-- Modal -->
<div class="nid-modal modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('National ID')</h4>
      </div>
      <div class="modal-body">
          <img src=""  alt="" class="img-responsive NID" style="margin:0 auto">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade trophy-modal" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          <img src=""  alt="" class="img-responsive trophy" style="margin:0 auto">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="edit-form" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('Edit Form')</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="show-form" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('View Form')</h4>
      </div>
      <div class="modal-body" style="display: inline-block; width: 100%">

      

<!-- show form -->

<div class="form-detail">
  
</div>
<!-- /show form -->


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
      </div>
    </div>

  </div>
</div>
</div>
{{--<script>--}}

{{--function approveForm(id, e) {--}}

          {{--var att = e.getAttribute('disabled');--}}
          {{--if(att)--}}
          {{--{--}}
            {{--return;--}}
          {{--}--}}
            {{--swal({--}}
        {{--text: "@lang('Are you sure you want to approve this?')",--}}
        {{--type: 'warning',--}}
        {{--showCancelButton: true,--}}
        {{--confirmButtonColor: '#3085d6',--}}
        {{--cancelButtonColor: '#d33',--}}
        {{--confirmButtonText: 'হা ',--}}
        {{--cancelButtonText: 'না '--}}
      {{--}).then(function () {--}}

        {{--$.post(url+'/'+id, {_token:_token, _method:'PUT', approval:'1'}, function () {--}}
           {{--$(e).attr('disabled', true);--}}
        {{--});--}}
         {{--}, function () {--}}
        {{--return false;--}}
      {{--})--}}
 {{----}}
{{--}--}}

{{--function forwardForm(id, e) {--}}
  {{--var att = e.getAttribute('disabled');--}}
  {{--if(att)--}}
  {{--{--}}
    {{--return;--}}
  {{--}--}}
  {{--$("#formid").val(id);--}}
  {{--$("#fwmodal").modal();--}}
{{--}--}}
	{{--$(function () {--}}
		 {{--var t = $('#datatable').DataTable({--}}
		        {{--processing: true,--}}
		        {{--serverSide: true,--}}
		        {{--ajax: {--}}
                  {{--url:window.location.pathname,--}}
                  {{--data: function (d) {--}}
                    {{--d.trackingNumber = $('input[name=trackingNumber]').val();--}}
                    {{--d.status = $('select[name=status]').val();--}}
                    {{--d.division = $('select[name=division]').val();--}}
                    {{--d.district = $('select[name=district]').val();--}}
                    {{--d.approval = $('select[name=approval]').val();--}}
                    {{--d.to = $('select[name=to]').val();--}}
                  {{--}--}}
                {{--},--}}
                {{--"columnDefs": [--}}
		        {{--{--}}
		            {{--"targets": -1,--}}
		            {{--"data": null,--}}
		            {{--"render":function (data, type, row) {--}}
                  {{--var disabled = "";--}}
                  {{--var approved = "";--}}
                  {{--if(row.status != null)--}}
                  {{--{--}}
                    {{--disabled = "disabled='true'";--}}
                  {{--}--}}
                  {{--if(row.approval != null)--}}
                  {{--{--}}
                    {{--approved = "disabled='true'";--}}
                  {{--}--}}
		            	{{--return "<div class=''><i onclick='showForm("+row.id+")' class='btn btn-default btn-sm fa fa-eye'></i><i onclick='showNID("+row.id+")' class='btn btn-warning btn-sm fa fa-address-card-o'></i>  @role(['ministry', 'bsc']) <i class='btn btn-success btn-sm fa fa-check'  onclick='approveForm("+row.id+", this)' "+approved+"></i>  @endrole  @role(['dc', 'nsc']) <i class='btn btn-success btn-sm fa fa-plus add_"+row.id+"'   onclick='forwardForm("+row.id+", this)' "+disabled+"></i>  @endrole <i class='btn btn-danger btn-sm fa fa-close'></i></div>";--}}
		            {{--}--}}
		        {{--},--}}
		         {{--],--}}
		        {{--columns: [--}}
		            {{--{ data: 'trackingNumber', name: 'trackingNumber' },--}}
		            {{--{ data: 'name', name: 'name' },--}}
		            {{--{ data: 'playerLevel', name: 'playerLevel' },--}}
		            {{--{ data: 'playerType', name: 'playerType' },--}}
		            {{--{ data: 'profession', name: 'profession' },--}}
		            {{--{ data: 'designation', name: 'designation' },--}}
		            {{--{ data: 'annualIncome', name: 'annualIncome' },--}}
		            {{--{ data: 'achievements', name: 'achievements' },--}}
                    {{--{ data: 'statusHtml', name: 'statusHtml' },--}}
		            {{--{ data: 'action', name: 'action' },--}}
		        {{--],--}}
		    {{--});--}}

{{--$.fn.dataTable.ext.errMode = 'throw';--}}
{{--$('.dForm').on('submit', function (e) {--}}
  {{--e.preventDefault();--}}
  {{--t.draw();--}}
  {{----}}
{{--});--}}

	{{--})--}}
{{--</script>--}}
@endsection