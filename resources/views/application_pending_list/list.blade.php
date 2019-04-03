@include('form-modal')
<!--              end search
-->

<style type="text/css">
  .table>tbody>tr>td{
    vertical-align: middle;
  }
</style>
	<div id="pending_print_id">
   <div  style="text-align: center;"><h3><strong>@lang('application.application_pending_list')</strong></h3>
      </div>
        <div class="table-responsive">
		<table id="listTable" class="datatable" cellspacing="0" width="100%">
		    <thead >
		    	<tr>
			      	<th>#</th>
              @role(['dc','nsc'])
               <th><input class="check-all" type="checkbox"></th>
              @endrole
              @role(['ministry','bsc'])
              <th><input class="check-all" type="checkbox"></th>
              @endrole
			        <th>@lang('application.applicant_name')</th>
                    <th>Applied For</th>
              <th>Mobile</th>
              @role(['ministry','bsc'])
              <th class="pending-status">@lang('application.priority')</th>

              @endrole
			        <th>District Name</th>
              <th>Quota</th>
                    @role(['dc'])
                    <th>Send Message</th>
                    @endrole
              @role(['dc','nsc'])
              <th class="pending-status" style="text-align: center;width: 100px;">@lang('default.action')</th>
              @endrole
              @role(['ministry','bsc'])
              <th class="pending-status" style="text-align: center;width: 42px;">@lang('default.action')</th>
              @endrole
		    	</tr>
		    </thead>
    		<tbody>
    		@foreach($records as $key => $record)
      			<tr>
      				<td>{{$key + 1}}</td>
              @role(['dc','nsc'])
                    <td><input type="checkbox" name="sendchecked[]" value="{{ $record->id }}"></td>
                {{--<td class="input_rating"><input type="text"  style="width:66px;" name="sendchecked[]" value="0" /><input type="hidden" name="app_limit" /></td>--}}
              @endrole
              @role(['ministry','bsc'])
              <td><input type="checkbox" name="checked[]" value="{{ $record->id }}"></td>
              @endrole
      				<td>{{ $record->applicant_name }}<input type="hidden" name="app_id[]" value="{{ $record->id }}" /></td>
                    <td>{{ $record->sport_name }}</td>
                    <td>{{ $record->mobile }}</td>
              @role(['ministry','bsc'])
              <td class="pending-status">{{ $record->rating}}</td>

              @endrole
      				<td>{{ $record->district_bn_name }}</td>
      				<td>{{ $record->bankAccNo}}</td>
                    @role(['dc'])
                    <td> <i onclick="sendMessage({{$record->id}})" class="btn btn-info btn-sm glyphicon glyphicon-envelope"
                            id="{{ $record->id}}"></i></td>
                    @endrole
              <td class="pending-status">
                <div class="">
                  <i onclick="showForm1({{$record->id}})" class="btn btn-default btn-sm fa fa-eye"></i>
                  @role(['dc','nsc'])
                  <i class="btn btn-danger btn-sm fa fa-close dc-app-delete" id="{{ $record->id}}"></i>

                  @endrole
                </div>
              </td>
      			</tr>
     		@endforeach
    		</tbody>
  		</table>
        </div>
        <script type="text/javascript">
        function PendingprintDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        }
        $(document).on('click', '#show-form  button.close', function(){
      $('.modal-backdrop').hide();
      $('#show-form').hide();
      //console.log('fgd');
      location.reload();
    })
    </script>
  	</div>

<script type="application/javascript">
    $(document).ready( function () {
        $('#listTable').DataTable({
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25
        });
    } );
</script>