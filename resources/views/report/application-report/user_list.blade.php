
<!--              end search            -->
<style type="text/css">
body {
  font-family: solaiman-lipi;
}
</style>
	<div id="print_id">
    <h2 align="center" style="color: #3c8dbc">
বঙ্গবন্ধু ক্রীড়াসেবী কল্যাণ ফাউন্ডেশন</h2>
		<table id="example" class="table table-hover report-table">
		    <thead>
		    	<tr>
			      	<th>#</th>
			        <th>@lang('application.applicant_name')</th>
              <th>পিতার নাম</th>
              <th>Name</th>
               @role(['ministry','bsc'])
			        <th>District Name</th>
               @endrole
			        <th>Applied For/th>
              <th>Mobile</th>
              <th>Quota</th>
              <th>জন্ম তারিখ</th>
		    	</tr>
		    </thead>
    		<tbody>

    		@foreach($records as $key => $record)
      			<tr>
      				<td>{{ toBangla($key + 1)}}</td>
      				<td>{{ $record->applicant_name }}</td> 
               <td>{{ $record->fatherName }}</td>
      				<td>{{ toBangla($record->mobile) }}</td>
              @role(['ministry','bsc'])
      				<td>{{ $record->district_bn_name }}</td>
              @endrole
      				<td>{{ $record->sport_name }}</td>
      				<td>{{ $record->player_type }}</td>
              <td>{{ $record->annual_income }}</td>
              <td>{{ toBangla($record->birth) }}</td>
      			</tr>
     		@endforeach
    		</tbody>
  		</table>
  	</div>
  		<div class="pagination-right">
  			{{ $records->links() }}
  		</div>


