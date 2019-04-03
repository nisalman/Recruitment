<div>
    <div>অ্যাসোসিয়েশান তালিকা</div>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>অ্যাসোসিয়েশানের নাম</th>
            <th>ঠিকানা</th>
            <th>খেলার নাম</th>
            <th>অবস্থা</th>
        
        </tr>

        </thead>
        <tbody>
        @foreach($associations as $key => $association)
            <tr>
                <td>{{ toBangla($key+1) }}</td>
                <td>{{ $association->name }}</td>
                <td>{{ $association->address }}</td>
                <td>@if($association->sport_name)
                        {{ $association->sport_name }}
                    @else
                        প্রযোজ্য নয়
                    @endif
                </td>
                <td>
                    @if($association->status == 1)
                        <span class="label label-success">সক্রিয়</span>
                    @else
                        <span class="label label-danger">নিষ্ক্রিয়</span>
                    @endif
                </td>
              
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $associations->links() }}
</div>


<script>
    $('.edit-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        $('#sports-form').trigger("reset");
        $('#sportsModal').modal('show');
        var association_id = $(this).data('id');
        $.get(sendUrl + '/' + association_id, function (data) {
            $('#association_id').val(data.id);
            $('#name').val(data.name);
            $('#address').val(data.address);
            $('#sport_id').val(data.sport_id);
            $('#status').val(data.status);
            $('#btn-save').val("update");
        });
    });

    $('.delete-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        var organizationId = $(this).data('id');
        var swalTitle = getSwalTitle();
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + organizationId,
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