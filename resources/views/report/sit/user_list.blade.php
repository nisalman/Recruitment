
<!--              end search            -->
<style type="text/css">
body {
  font-family: solaiman-lipi;
}
</style>

	<div id="print_id">
    <h2 align="center" style="color: #3c8dbc">
Seat Plan</h2>
		<table class="table table-bordered" id="myTable">
			<thead>
			<tr>
				<th style="width: 10px">#</th>
				<th>Room Number</th>
				<th>Center Name</th>
				<th>Floor</th>
				<th>Sit Capacity</th>
				<th>From - To</th>
			</tr>

			</thead>
			<tbody>
			@php
				$a=0;
			@endphp

			@foreach($records as $record)
				@php
				$key=$a;
				@endphp
				<tr>
					<td>{{$key+1}}</td>
					<td>{{ $record['room_name']}}</td>
					<td>{{ $record['center_name']}}</td>
					<td>{{ $record['room_floor']}}</td>
					<td>{{ $record['capacity']}}</td>
					<td>{{ $record['0']}} - {{ $record['1']}}</td>
					<td></td>
					@php
						$a++;
					@endphp
				</tr>
			@endforeach
			</tbody>
		</table>
  	</div>

<script>
	$(document).ready( function () {
		$('#myTable').DataTable({
			"aLengthMenu": [[10, 25, 50, 75,100, 1000, -1], [10, 25, 50, 75, 100, 1000, "All"]],
			"iDisplayLength": 10
		})
	} );
</script>

