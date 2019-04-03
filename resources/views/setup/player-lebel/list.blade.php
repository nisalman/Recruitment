<div>
   
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>পর্যায় নাম</th>
            <th>অবস্থা</th>
            <th style="width: 125px">সংশোধন/মুছুন</th>
        </tr>

        </thead>
        <tbody>
        @foreach($player_lebels as $key => $player_lebel)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ $player_lebel->name }}</td>                
                <td>
                    @if($player_lebel->status == 1)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-danger">Deactivate</span>
                    @endif
                </td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$player_lebel->id}}"></i>
                        <i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$player_lebel->id}}"></i>
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
        var player_lebel_id = $(this).data('id');
        $.get(sendUrl + '/' + player_lebel_id, function (data) {
            $('#player_lebel_id').val(data.id);
            $('#name').val(data.name);
            $('#status').val(data.status);
            $('#btn-save').val("update");
        });
    });
    $('.delete-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        var player_lebel_id = $(this).data('id');
        var swalTitle = getSwalTitle();
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + player_lebel_id,
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