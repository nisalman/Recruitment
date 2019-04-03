<div>

    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Num of Room</th>
            <th>Location</th>
            <th>Status</th>
            <th style="width: 125px">Edit/Delete</th>
        </tr>

        </thead>
        <tbody>
        @foreach($centers as $key => $center)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{$center->name}}</td>
                <td>{{$center->num_room}}</td>
                <td>{{$center->location}}</td>
                <td>
                    @if($center->status==1)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-danger">Deactivate</span>
                    @endif
                </td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$center->id}}"></i>
                        <i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$center->id}}"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $('.edit-btn').on('click', function () {
        var sendUrl = window.location.pathname;
        $('#sports-form').trigger("reset");
        $('#sportsModal').modal('show');
        var center_id = $(this).data('id');
        $.get(sendUrl + '/' + center_id, function (data) {
            $('#center_id').val(data.id);
            $('#name').val(data.name);
            $('#num_room').val(data.num_room);
            $('#location').val(data.location);
            $('#status').val(data.status);
            $('#btn-save').val("update");
        });
    });
    $('.delete-btn').on('click', function () {
        var sendUrl = window.location.pathname;
        var center_id = $(this).data('id');
        var swalTitle = getSwalTitle();
        console.log(center_id);
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + center_id,
                type: 'DELETE',
                success: function (result) {

                    $.get(window.location.pathname).done(function (data) {
                        eval($('.list-container').html(data));
                        $("#datatable").dataTable({"bPaginate": false, "order": []});
                    }).fail(function () {
                        alert('Result could not be loaded.');
                    });
                }
            });
        }, function (dismiss) {
            swalCancelConfirm(dismiss);
        });
    });
</script>