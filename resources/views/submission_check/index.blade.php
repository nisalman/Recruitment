@extends('layouts.admin')
@section('content')
    <div class="container-narrow">
        <div>
            @include('submission_check.form')
        </div>
        <div class="list-container">
            @include('submission_check.list')
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#datatable").dataTable({"bPaginate": true, "order": []});
            //display modal form for creating new task
        });
    </script>
@endsection