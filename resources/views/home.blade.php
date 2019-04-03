@extends('layouts.web')
@section('content')

<div class="col-md-12 home_content">
  <a href="/application-form"> <h3> আবেদন করুন</h3></a> 
</div>


<script>
	$('#title').html("@lang("Welcome"){{auth()->user()->name}}");
</script>
@endsection