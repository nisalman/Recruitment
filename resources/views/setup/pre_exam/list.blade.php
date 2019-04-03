<div>
   
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Grade</th>
            <th>Remarks</th>
            <th>Point</th>
            <th style="width: 100px">Exam Type</th>
            <th style="width: 175px">Edit/Delete</th>
        </tr>

        </thead>
        <tbody>

        @foreach($pre_exam as $key => $exam)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ $exam->name }}</td>
                <td>{{ $exam->remarks }}</td>
                <td>{{ $exam->point }}</td>
                <td>
                    @if($exam->flag == 1)
                        <span class="label label-success">SSC</span>
                    @elseif($exam->flag == 2)
                        <span class="label label-info">HSC</span>
                    @elseif($exam->flag == 3)
                            <span class="label label-primary">Graduation</span>
                    @endif
                </td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$exam->id}}"></i>
                        <i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$exam->id}}"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    const selector = {1: "SSC", 2: "HSC", 3: "GRADUATION", 4: "POST GRADUATION"};

    $('.edit-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        $('#sports-form').trigger("reset");
        $('#sportsModal').modal('show');
        var exam_id = $(this).data('id');
        $.get(sendUrl + '/' + exam_id, function (data) {
            // eval(data)
            $('#exam_id').val(data.id);
            $('#name').val(data.name);
            $('#remarks').val(data.remarks);
            $('#point').val(data.point);
            $('#flag').val(selector[data.flag]);
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