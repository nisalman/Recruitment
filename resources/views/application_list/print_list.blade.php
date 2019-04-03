
@extends('layouts.admin')
@section('content')

    {{ Form::open(array(url()->current(),'class' => 'common_form')) }}
    <!--          search            -->
    @include('search_panel')
    <!--              end search            -->
    <div class="search_result">
        @include('application_list.list')
    </div>

    {{ Form::close() }}
@endsection


