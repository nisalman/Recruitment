@extends('layouts.admin')
@section('content')
    <form method="post" class="se-form" data-name="sports-setup">
        {{csrf_field()}}

        <div class="form-group">
            <div class="title">ফেডারেশন নিবন্ধন</div>

            <div class="col-md-3">
                <label for="">ফেডারেশনের নাম</label>
                <input type="text" name="name" class="form-control bn" required="">
            </div>

            <div class="col-md-3">
                <label for="">ঠিকানা </label>
                <input type="text" class="form-control bn" name="address">
            </div>

            <div class="col-md-3">
                <label for="">খেলার নাম</label>
                <select name="sport_id" id="" class="form-control" required="">
                    <option value="">--</option>
                    @foreach(App\Sport::all() as $sport)
                        <option value="{{$sport->id}}">{{$sport->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="">@lang('default.status')</label>
                <select name="status" id="" class="form-control">
                    <option value="1">@lang('default.active')</option>
                    <option value="0">@lang('default.inactive')</option>
                </select>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-success btn-sm pull-right"> সংরক্ষন করুন</button>
            </div>
        </div>

    </form>

    <div class="col-md-12 c-wrapper">
        <table id="datatable" class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>ফেডারেশনের নাম</th>
                <th>ঠিকানা</th>
                <th>খেলার নাম</th>
                <th>অবস্থা</th>
                <th style="width: 120px">সংশোধন/মুছুন</th>
            </tr>
            </thead>
        </table>
    </div>

    <script>
        $(function () {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: window.location.pathname,
                "columnDefs": [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<div class='showing'><i class='btn btn-default btn-sm fa fa-pencil'></i><i class='btn btn-danger btn-sm fa fa-trash'></i></div><div class='editing'><i class='btn btn-success btn-sm fa fa-check'></i><i class='btn btn-danger btn-sm fa fa-close'></i></div>"
                }],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    {data: 'sport_id', name: 'sport_id'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ],
            });

            $('#datatable').on('click', '.fa-pencil', function () {
                var data = table.row($(this).parents('tr')).data();
                var row = $(this).parents('tr');
                row.find('.editing').show();
                row.find('.showing').hide();
            });

            $('#datatable').on('click', '.fa-check', function () {
                var data = table.row($(this).parents('tr')).data();
                var row = $(this).parents('tr');
                var id = data.id;
                form = {};
                $.each(data, function (k, v) {
                    form[k] = $('#' + id + '_' + k).val();
                });
                form.id = id;
                form._method = 'PUT';
                form._token = _token;
                $.ajax({
                    type: 'POST',
                    url: url + '/' + id,
                    data: form,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function (data) {

                    $('#datatable').DataTable().ajax.reload();
                });
            });

            $('#datatable').on('click', '.fa-trash', function () {
                var data = table.row($(this).parents('tr')).data();
                var row = $(this).parents('tr');
                var id = data.id;
                form = {};

                form.id = id;
                form._method = 'DELETE';
                form._token = _token;
                swal({
                    text: "আপনি কি নিশ্চিত?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'হা '
                }).then(function () {
                    // delete
                    row.css('background', '#ddd');
                    $.ajax({
                        type: 'DELETE',
                        data: form,
                        url: url + '/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).done(function (data) {
                        row.hide();
                    });
                }, function () {
                    return false;
                })
            });

            $('#datatable').on('click', '.fa-close', function () {
                var data = table.row($(this).parents('tr')).data();
                var row = $(this).parents('tr');
                row.find('.editing').hide();
                row.find('.showing').show();
            });
        });

    </script>

@endsection