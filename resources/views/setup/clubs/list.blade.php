<div>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Image Type</th>
            <th>Image Size (KB)</th>
            <th>Height</th>
            <th>Width</th>
            <th style="width: 125px">Edit</th>
        </tr>

        </thead>
        <tbody>
        @foreach($clubs as $key => $club)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $club->name }}</td>
                <td>{{ $club->address }}</td>
                <td>{{ $club->height }}</td>
                <td>{{ $club->width }}</td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$club->id}}"></i>
                        {{--<i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$club->id}}"></i>--}}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $('.edit-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        $('#clubs-form').trigger("reset");
        $('#sportsModal').modal('show');
        var club_id = $(this).data('id');
        $.get(sendUrl + '/' + club_id, function (data) {
            $('#club_id').val(data.id);
            $('#name').val(data.name);
            $('#address').val(data.address);
            $('#height').val(data.height);
            $('#width').val(data.width);
            $('#btn-save').val("update");
        });
    });
    $('.delete-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        var club_id = $(this).data('id');
        var swalTitle = getSwalTitle();
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + club_id,
                type: 'DELETE',
                success: function(result) {
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