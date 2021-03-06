@extends('layouts.admin')
@section('content')

    <form method="post" class="se-form" action="{{ url('/admin/users') }}" data-name="sports-setup">
        {{csrf_field()}}


        <div class="form-group">
            <div class="title">@lang('Create New User') </div>

            <div class="col-md-4">
                <label for="">@lang('Name')</label>
                <input type="text" name="name" class="form-control" required="">
            </div>

            <div class="col-md-2">
                <label for="">@lang('Username')</label>
                <input type="text" name="username" class="form-control" required="">
            </div>

            <div class="col-md-2">
                <label for="">@lang('Password')</label>
                <input type="password" name="password" class="form-control" required="">
            </div>

{{--            <div class="col-md-2">
                <label for="">@lang('Designation')</label>
                <select name="designation_id" class="form-control" required="">
                    <option>---</option>
                    @foreach(App\Designation::all() as $designation)
                        <option value="{{$designation->id}}">{{$designation->name}}</option>
                    @endforeach
                </select>
            </div>--}}

            <div class="col-md-2">
                <label for="">Status</label>
                <select name="status" id="" class="form-control" required="">
                    <option value="1">Active</option>
                    <option value="0">Deactivate</option>
                </select>
            </div>


            <div class="col-md-4">
                <label for="">@lang('Roles')</label>
                <select name="roles" class="form-control" required="">
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
{{--            <div class="col-md-8">
                <h5>@lang('Roles')</h5>
                <label class="checkbox-inline label label-sm label-primary col-md-2"><input name="dc_select"
                class="seCheckbox"
                type="checkbox"
                value="0">       {{ trim('DC Select') }}        </label>
            </div>--}}


            <div class="col-md-12">
                <button type="submit" class="btn btn-success btn-sm pull-right"> Save</button>
            </div>
        </div>

    </form>
<?php
//        echo '<pre>';
//        print_r($users['role'] );
//        exit();
//?>
    <div class="col-md-12 c-wrapper">
        <table id="datatable" class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>@lang('Name')</th>
                <th>@lang('Username')</th>
                {{--<th>@lang('Designation')</th>--}}
                <th>@lang('Roles')</th>
                <th>Status</th>
                <th style="width: 125px">Edit/Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key +1}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    {{--<td>{{ $user->designation_name }}</td>--}}

                    <td>@if($user->role_id == 1)
                            Developer
                        @elseif($user->role_id   == 3)
                            NSC
                        @elseif($user->role_id   == 2)
                            DC Office
                        @elseif($user->role_id   == 4)
                            Ministry
                        @elseif($user->role_id   == 5)
                            BSC
                        @endif
                    </td>

                    <td>@if($user->status == 1)
                            <span class="label label-success">Active</span>
                        @else
                            <span class="label label-danger">Deactivate</span>
                        @endif</td>
                    <td>
                        <a href="/admin/users/{{ $user->id }}/edit"><i class='btn btn-default btn-sm fa fa-pencil'></i></a>
                        <a href="/admin/users/{{ $user->id }}/delete" onclick="return checkDelete()" class="btn btn-danger"><i class="icon-trash"></i></a>

                        {{--<span style="display: inline-block">--}}
                        {{--<form action="/admin/users/{{ $user->id }}" data-name="sports-setup" method="post"--}}
                              {{--class="form-group" style="margin-bottom: 0px">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--{{ method_field('DELETE') }}--}}
                            {{--<button class="form-control" style="border: none;padding: 0; margin: 0;"><i--}}
                                        {{--class='btn btn-danger btn-sm fa fa-trash'></i></button>--}}
                        {{--</form>--}}
                    {{--</span>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
    <script>
        $(function() {
            var table =$('#datatable').DataTable({
                processing: false,
                serverSide: false,

                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'username', name: 'username' },
                    { data: 'designation', name: 'designation' },
                    { data: 'roles', name: 'roles' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                ],
            });


            $('#datatable').on( 'click', '.fa-pencil', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var row = $(this).parents('tr');
                row.find('.editing').show();
                row.find('.showing').hide();
            } );

            $('#datatable').on( 'click', '.fa-check', function () {

                var data = table.row( $(this).parents('tr') ).data();
                var row = $(this).parents('tr');
                var id = data.id;
                form ={};
                $.each(data, function (k, v) {
                    form[k] = $('#'+id+'_'+k).val();
                });
                form.id = id;
                form._method = 'PUT';
                form._token = _token;
                $.ajax({
                    type: 'POST',
                    url: url+'/'+id,
                    data:form,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function(data) {

                    $('#datatable').DataTable().ajax.reload();
                });

            } );
            $('#datatable').on( 'click', '.fa-trash', function () {

                var data = table.row( $(this).parents('tr') ).data();
                var row = $(this).parents('tr');
                var id = data.id;
                form ={};

                form.id = id;
                form._method = 'DELETE';
                form._token = _token;
                swal({
                    text: "আপনি কি নিশ্চিত?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'হা ',
                    cancelButtonText: 'না '
                }).then(function () {
                    // delete
                    row.css('background', '#ddd');
                    $.ajax({
                        type: 'DELETE',
                        data:form,
                        url: url+'/'+id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).done(function(data) {
                        row.hide();
                    });
                }, function () {
                    return false;
                })

            } );

            $('#datatable').on( 'click', '.fa-close', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var row = $(this).parents('tr');
                row.find('.editing').hide();
                row.find('.showing').show();
            } );


        });


    </script>



@endsection