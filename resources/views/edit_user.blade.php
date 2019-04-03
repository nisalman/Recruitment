@extends('layouts.admin')
@section('content')

{{--{!! Form::open(['url'=> '/admin/update_user','method'=>'post' ,'name'=>'updateUser' ]) !!}--}}
    <form method="post"  action="{{ url('/admin/update_user') }}" data-name="edit_user" id="edit_user">
        {{csrf_field()}}
        <div class="form-group">
            <div class="title">@lang('Update User,') {{ $user_data->name}}</div>
            <div class="col-md-4">
                <label for="">@lang('Name')</label>
                <input type="text" name="name" id="name" class="form-control" required="" value="{{ $user_data->name}}">
                <input type="hidden" name="id" id="name" class="form-control" required="" value="{{ $user_data->id}}">
            </div>

            <div class="col-md-2">
                <label for="">@lang('Username')</label>
                <input type="text" name="username" id="username" class="form-control" required="" value="{{ $user_data->username }}">
            </div>

            <div class="col-md-2">
                <label for="">@lang('Password')</label>
                <input type="password" id= "password" name="password" class="form-control" required="" value="{{$user_data->password}}">
            </div>

            {{--<div class="col-md-2">
                <label for="">@lang('Designation')</label>
                <select name="deg" class="form-control" value="deg">
                    <option>---</option>
                    @foreach(App\Designation::all() as $designation)
                        <option value="{{$designation->id}}">{{$designation->name}}</option>
                    @endforeach
                </select>
            </div>--}}

            <div class="col-md-2">
                <label for="">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1">Activate</option>
                    <option value="0">Deactivate</option>
                </select>
            </div>


            <div class="col-md-4">
                <label for="">@lang('Roles')</label>
                <select name="roles" class="form-control" id="roles">
                    <option>---</option>
                    @foreach(App\Role::where('name', '!=', 'dev')->orderBy('name', 'asc')->get() as $role)
                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                    @endforeach
                </select>
                {{--<label class="checkbox-inline label label-sm label-primary col-md-2"><input name="roles[]"--}}
                {{--class="seCheckbox"--}}
                {{--type="checkbox"--}}
                {{--value="{{$role->id}}">{{$role->display_name}}--}}
                {{--</label>--}}
            </div>
            {{--<div class="col-md-8">
                <h5>@lang('Roles')</h5>
                <label class="checkbox-inline label label-sm label-primary col-md-2"><input name="dc_select"
                                                                                            class="seCheckbox"
                                                                                            type="checkbox"
                                                                                            value="0">       {{ trim('DC Select') }}        </label>
            </div>--}}


            <div class="col-md-12">
                <button type="submit" class="btn btn-success btn-sm pull-right">Save</button>
            </div>
        </div>
</form>


    {{--<div class="col-md-12 c-wrapper">--}}
        {{--<table id="datatable" class="table table-bordered">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th style="width: 10px">#</th>--}}
                {{--<th>@lang('Name')</th>--}}
                {{--<th>@lang('Username')</th>--}}
                {{--<th>@lang('Designation')</th>--}}
                {{--<th>@lang('Roles')</th>--}}
                {{--<th>অবস্থা</th>--}}
                {{--<th style="width: 125px">সংশোধন/মুছুন</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--@foreach($users as $key => $user)--}}
                {{--<tr>--}}
                    {{--<td>{{ toBangla($key +1 )}}</td>--}}
                    {{--<td>{{ $user->name }}</td>--}}
                    {{--<td>{{ $user->username }}</td>--}}
                    {{--<td>{{$user->designation_name}}</td>--}}
                    {{--<td>@if($user->designation_id == 1)--}}
                            {{--DC--}}
                        {{--@elseif($user->designation_id == 3)--}}
                            {{--NSC--}}
                        {{--@elseif($user->designation_id == 2)--}}
                            {{--Authorization--}}
                        {{--@endif</td>--}}
                    {{--<td>@if($user->status == 1)--}}
                            {{--<span class="label label-success">সক্রিয়</span>--}}
                        {{--@else--}}
                            {{--<span class="label label-danger">নিষ্ক্রিয়</span>--}}
                        {{--@endif</td>--}}
                    {{--<td>--}}
                        {{--<a href="/admin/users/{{ $user->id }}/edit"><i class='btn btn-default btn-sm fa fa-pencil'></i></a>--}}
                        {{--<a href="admin/userss/{{ $user->id }}" onclick="confirm('Are you Sure to Delete')"><i class='btn btn-danger btn-sm fa fa-trash'></i></a>--}}
                        {{--<span style="display: inline-block">--}}
                        {{--<form action="/admin/users/{{ $user->id }}" data-name="sports-setup" method="post"--}}
                        {{--class="form-group" style="margin-bottom: 0px">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--{{ method_field('DELETE') }}--}}
                        {{--<button class="form-control" style="border: none;padding: 0; margin: 0;"><i--}}
                        {{--class='btn btn-danger btn-sm fa fa-trash'></i></button>--}}
                        {{--</form>--}}
                        {{--</span>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}
            {{--</tbody>--}}

        {{--</table>--}}
    {{--</div>--}}
    {{--<script>--}}
        {{--$(function() {--}}
            {{--var table =$('#datatable').DataTable({--}}
                {{--processing: false,--}}
                {{--serverSide: false,--}}

                {{--columns: [--}}
                    {{--{ data: 'id', name: 'id' },--}}
                    {{--{ data: 'name', name: 'name' },--}}
                    {{--{ data: 'username', name: 'username' },--}}
                    {{--{ data: 'designation', name: 'designation' },--}}
                    {{--{ data: 'roles', name: 'roles' },--}}
                    {{--{ data: 'status', name: 'status' },--}}
                    {{--{ data: 'action', name: 'action' },--}}
                {{--],--}}
            {{--});--}}


            {{--$('#datatable').on( 'click', '.fa-pencil', function () {--}}
                {{--var data = table.row( $(this).parents('tr') ).data();--}}
                {{--var row = $(this).parents('tr');--}}
                {{--row.find('.editing').show();--}}
                {{--row.find('.showing').hide();--}}
            {{--} );--}}

            {{--$('#datatable').on( 'click', '.fa-check', function () {--}}

                {{--var data = table.row( $(this).parents('tr') ).data();--}}
                {{--var row = $(this).parents('tr');--}}
                {{--var id = data.id;--}}
                {{--form ={};--}}
                {{--$.each(data, function (k, v) {--}}
                    {{--form[k] = $('#'+id+'_'+k).val();--}}
                {{--});--}}
                {{--form.id = id;--}}
                {{--form._method = 'PUT';--}}
                {{--form._token = _token;--}}
                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: url+'/'+id,--}}
                    {{--data:form,--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--}--}}
                {{--}).done(function(data) {--}}

                    {{--$('#datatable').DataTable().ajax.reload();--}}
                {{--});--}}



            {{--} );--}}
            {{--$('#datatable').on( 'click', '.fa-trash', function () {--}}

                {{--var data = table.row( $(this).parents('tr') ).data();--}}
                {{--var row = $(this).parents('tr');--}}
                {{--var id = data.id;--}}
                {{--form ={};--}}

                {{--form.id = id;--}}
                {{--form._method = 'DELETE';--}}
                {{--form._token = _token;--}}
                {{--swal({--}}
                    {{--text: "আপনি কি নিশ্চিত?",--}}
                    {{--type: 'warning',--}}
                    {{--showCancelButton: true,--}}
                    {{--confirmButtonColor: '#3085d6',--}}
                    {{--cancelButtonColor: '#d33',--}}
                    {{--confirmButtonText: 'হা ',--}}
                    {{--cancelButtonText: 'না '--}}
                {{--}).then(function () {--}}
                    {{--// delete--}}
                    {{--row.css('background', '#ddd');--}}
                    {{--$.ajax({--}}
                        {{--type: 'DELETE',--}}
                        {{--data:form,--}}
                        {{--url: url+'/'+id,--}}
                        {{--headers: {--}}
                            {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                        {{--}--}}
                    {{--}).done(function(data) {--}}
                        {{--row.hide();--}}
                    {{--});--}}
                {{--}, function () {--}}
                    {{--return false;--}}
                {{--})--}}

            {{--} );--}}

            {{--$('#datatable').on( 'click', '.fa-close', function () {--}}
                {{--var data = table.row( $(this).parents('tr') ).data();--}}
                {{--var row = $(this).parents('tr');--}}
                {{--row.find('.editing').hide();--}}
                {{--row.find('.showing').show();--}}
            {{--} );--}}


        {{--});--}}




    {{--</script>--}}
<script type="text/javascript">

    document.forms['edit_user'].elements['status'].value='<?php echo $user_data->status ?>' ;
    document.forms['edit_user'].elements['deg'].value='<?php echo  $user_data->designation_id ?>' ;
    document.forms['edit_user'].elements['roles'].value='<?php echo  $user_data->role_id ?>' ;
</script>
@stop
{{----}}
