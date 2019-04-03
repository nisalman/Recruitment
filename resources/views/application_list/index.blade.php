

@extends('layouts.admin')
@section('content')

{{ Form::open(array(url()->current(),'class' => 'common_form')) }}
 	<div  style="color:red; text-align: right;"><button type="button" class="btn btn-info" onclick="printDiv('print_id')">print</button></div>
<!--          search            -->
@include('search_panel')
<!--              end search            -->
  <div class="search_result">
    @include('application_list.list')
  </div>

	{{ Form::close() }}
@endsection


