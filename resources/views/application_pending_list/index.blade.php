
@extends('layouts.admin')
@section('content')

{{ Form::open(array(url()->current(),'class' => 'common_form')) }}

<div  style="color:red; text-align: right;"><button type="button" class="btn btn-info" onclick="PendingprintDiv('pending_print_id')">print</button></div>
<!--          search            -->
@include('search_panel')
<!--              end search            -->
  <div>    
  	<div class="row">
  		<div class="col-md-12">
        @role(['dc','nsc'])
  			<label class="radio-inline">
      			<input type="radio" value="2" name="m_b">Super Admin
		    </label>
		    {{--<label class="radio-inline">--}}
		    	{{--<input type="radio" value="1" name="m_b">মন্ত্রণালয়--}}
		    {{--</label>--}}
		    <label class="radio-inline">
		    	<button type="button" id="bm-send" class="btn btn-warning btn-sm" style="margin-top: 0px;margin-left: -20px;">@lang('default.send')</button>
		    </label>
        @endrole
        @role(['ministry','bsc'])
          <label class="radio-inline">
          <button type="button" id="bm-approve" class="btn btn-warning btn-sm" style="margin-top: 0px;margin-left: -20px;">@lang('default.approve')</button>
          </label>
        @endrole
  		</div>
     
  	</div>

    <div class="search_result">  
      @include('application_pending_list.list')
    </div>  
  </div>
  		
	{{ Form::close() }}
@endsection


