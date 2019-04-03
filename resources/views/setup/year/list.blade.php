<div>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>ইয়ার নাম</th>
            
            <th>অবস্থা</th>
            <th style="width: 125px">সংশোধন/মুছুন</th>
        </tr>

        </thead>
        <tbody>
        @foreach($years as $key => $year)
            <tr>
                <td>{{ toBangla($key+1) }}</td>
                <td>{{ $year->year_name }}</td>
                
                <td>
                    @if($year->status == 1)
                        <span class="label label-success">সক্রিয়</span>
                    @else
                        <span class="label label-danger">নিষ্ক্রিয়</span>
                    @endif
                </td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$year->id}}"></i>
                        <i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$year->id}}"></i>
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
        //console.log(sendUrl);return;
        $('#sports-form').trigger("reset");
        $('#sportsModal').modal('show');
        var year_id = $(this).data('id');
       
        $.get(sendUrl + '/' + year_id, function (data) {
            //console.log(data);
            $('#year_id').val(data.id);
            $('#name').val(data.year_name);
           
            $('#status').val(data.status);
            $('#btn-save').val("update");
        });
    });
    $('.delete-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        var year_id = $(this).data('id');
        var swalTitle = getSwalTitle();
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + year_id,
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
    $('input[type="search"]').addClass('bn');
</script>