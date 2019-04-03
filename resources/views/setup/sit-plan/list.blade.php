<div>

    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Center Name</th>
            <th>Capacity of Seat</th>
            <th>Location</th>
            <th>Floor</th>
            <th>Status</th>
            <th style="width: 125px">Edit/Delete</th>
        </tr>

        </thead>
        <tbody>

        @foreach($rooms as $key => $room)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{$room->name }}</td>
                <td>{{$room->center['name']}}</td>
                <td>{{$room->capacity}}</td>
                <td>{{$room->location}}</td>
                <td>{{$room->floor}}</td>
                <td>
                    @if($room->status==1)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-danger">Deactivate</span>
                    @endif
                </td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$room->id}}"></i>
                        <i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$room->id}}"></i>
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
        var room_id = $(this).data('id');
        $.get(sendUrl + '/' + room_id, function (data) {
            $('#room_id').val(data.id);
            $('#center_id').val(data.center_id);
            $('#name').val(data.name);
            $('#capacity').val(data.capacity);
            $('#location').val(data.location);
            $('#floor').val(data.floor);
            $('#status').val(data.status);
            $('#btn-save').val("update");
        });
    });
    $('.delete-btn').on('click', function () {
        var sendUrl = window.location.pathname;
        var profession_id = $(this).data('id');
        var swalTitle = getSwalTitle();
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + profession_id,
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