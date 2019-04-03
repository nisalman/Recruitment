
@extends('layouts.admin')
@section('content')

{{ Form::open(array(url()->current(),'class' => 'common_form')) }}
<div class="row">
  <div class="col-md-12">
    <a class="btn btn-info btn-xs"  id="export-print" onclick="printDiv('print_id')">
            <i class="fa fa-print"></i> <?php echo "&nbsp&nbsp"."Print"."&nbsp&nbsp"; ?>
        </a>
  </div>
</div>
<br>
<!--          search            -->
@include('search_panel')
<!--              end search            -->
  <div class="search_result">
    @include('report.application.list')
  </div>
  		
	{{ Form::close() }}
@endsection


