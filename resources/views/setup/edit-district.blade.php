	@extends('layouts.admin')
	@section('content')
<form method="post" class="se-form" data-name="sports-setup">
{{csrf_field()}}

<div class="form-group">
	<div class="title">Update Data </div>
	
		<div class="col-md-4">
			<label for="">District</label>
			<input type="text" name="name"  class="form-control" required="">
		</div>

		<div class="col-md-4">
			<label for="">District Bangla</label>
		<input type="text" name="name"  class="form-control bn" required="">

		</div>
		
		<div class="col-md-12">
	 		<button type="submit" class="btn btn-success btn-sm pull-right"> Update</button>
		</div>
</div>
                    
</form>

	@endsection