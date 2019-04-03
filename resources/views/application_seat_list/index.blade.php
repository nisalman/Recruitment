
@extends('layouts.admin')
@section('content')

{{ Form::open(array(url()->current(),'class' => 'common_form')) }}
@include('search_panel')
<div class="container">
    <div class="row">
        <div class="col-md-6 left" style="color:red; text-align: left;">
            <button type="button" class="btn btn-success" onclick="location.href='{{ url('admin/setup/sit-generate') }}'">Sit Generate</button>
        </div>
        <div class="col-md-6"  style="color:red; text-align: right;">
            <button type="button" class="btn btn-info" onclick="printDiv('print_id')">print</button>
        </div>
    </div>
</div>
<!--          search            -->

<!--              end search            -->
  <div class="search_result">
    @include('application_seat_list.list')
  </div>

	{{ Form::close() }}
@endsection


