@extends('layouts.admin')
@section('content')
    <a href="/updatetest" method="post"><i class='btn btn-default'></i>done</a>
<button action="/updatetest" name="bu">Check </button>
<form action="http://google.com">
    <input type="submit" value="Go to Google" />
</form>
    <form action="/action_page.php">
        First name: <input type="text" name="fname"><br>
        <input type="image" src="submit.gif" alt="Submit" width="48" height="48">
    </form>
{{--{!! Form::open(['url'=> '/updatetest','method'=>'post', 'enctype'=>'multipart/form-data' ,'name'=>'edit-blog' ,'class'=>'cmxform form-horizontal', 'id'=>'signupForm']) !!}--}}

        {{--<input class="span6 " id="firstname"  name="blog_title" type="text" />--}}
        {{--<input class="span6 " id="firstname"  name="blog_id" type="hidden" />--}}
{{--<button class="btn btn-success" type="submit">Update</button>--}}

{{--{!! Form::close() !!}--}}
