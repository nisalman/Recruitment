<div>
    <div><h4>ফেডারেশন তালিকা</h4></div>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>ফেডারেশনের নাম</th>
            <th>ঠিকানা</th>
            <th>খেলার নাম</th>
            <th>অবস্থা</th>
          
        </tr>

        </thead>
        <tbody>
        @foreach($federations as $key => $federation)
            <tr>
                <td>{{ toBangla($key+1) }}</td>
                <td>{{ $federation->name }}</td>
                <td>{{ $federation->address }}</td>
                <td>@if($federation->sport_name)
                        {{ $federation->sport_name }}
                    @else
                        প্রযোজ্য নয়
                    @endif
                </td>
                <td>
                    @if($federation->status == 1)
                        <span class="label label-success">সক্রিয়</span>
                    @else
                        <span class="label label-danger">নিষ্ক্রিয়</span>
                    @endif
                </td>
              
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $('.edit-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        $('#sports-form').trigger("reset");
        $('#sportsModal').modal('show');
        var federation_id = $(this).data('id');
        $.get(sendUrl + '/' + federation_id, function (data) {
            $('#federation_id').val(data.id);
            $('#name').val(data.name);
            $('#address').val(data.address);
            $('#sport_id').val(data.sport_id);
            $('#status').val(data.status);
            $('#btn-save').val("update");
        });
    });
    $('.delete-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        var federation_id = $(this).data('id');
        var swalTitle = getSwalTitle();
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + federation_id,
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