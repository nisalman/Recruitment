<div>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>খেলার নাম</th>
            <th>ফেডারেশনের নাম</th>
            <th>অ্যাসোসিয়েশানের নাম</th>
            <th>অবস্থা</th>
            <th style="width: 125px">সংশোধন/মুছুন</th>
        </tr>

        </thead>
        <tbody>
        @foreach($sports as $key => $sport)
            <tr>
                <td>{{ toBangla($key+1) }}</td>
                <td>{{ $sport->name }}</td>
                <td>
                    @if($sport->fedarName)
                        {{ $sport->fedarName }}
                    @else
                        প্রযোজ্য নয়
                    @endif
                </td>
                <td>
                    @if($sport->asso_name)
                        {{ $sport->asso_name }}
                    @else
                        প্রযোজ্য নয়
                    @endif
                </td>

                <td>
                    @if($sport->status == 1)
                        <span class="label label-success">সক্রিয়</span>
                    @else
                        <span class="label label-danger">নিষ্ক্রিয়</span>
                    @endif
                </td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$sport->id}}"></i>
                        <i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$sport->id}}"></i>
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
        $('#sports-form').trigger("reset");
        $('#sportsModal').modal('show');
        var sports_id = $(this).data('id');
        $.get(sendUrl + '/' + sports_id, function (data) {
            $('#sports_id').val(data.id);
            $('#name').val(data.name);
            $('#status').val(data.status);
            $('#is_federation').val(data.federations_id);
            $('#is_association').val(data.associations_id);
            
            if (data.federations_id) {
                $('#federation').prop('checked', true);
                $('#federation').prop('disabled', false);
                
            }
            if (data.associations_id) {
                $('#association').prop('checked', true);
                $('#association').prop('disabled', false);
            }
            $('#btn-save').val("update");
        });
    });
    $('.delete-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        var sports_id = $(this).data('id');
        var swalTitle = getSwalTitle();
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + sports_id,
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