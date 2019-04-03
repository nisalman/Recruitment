<div>

    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Available Jobs</th>
            <th>SSC</th>
            <th>HSC</th>
            <th>Graduation</th>
            <th>Post Graduation</th>
            <th>Job Post Date</th>
            <th>Last Date of Application</th>
            <th>Status</th>
            <th style="width: 125px">Edit/Delete</th>
        </tr>

        </thead>
        <tbody>
        @foreach($professions as $key => $profession)
            <tr>
                <td>{{ $key+1  }}</td>
                <td>{{ $profession->name }}</td>
                <td>
                    @if($profession->ssc == 1)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-danger">Deactivate</span>
                    @endif
                </td>
                <td>
                    @if($profession->hsc == 1)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-danger">Deactivate</span>
                    @endif
                </td>
                <td>
                    @if($profession->grad == 1)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-danger">Deactivate</span>
                    @endif
                </td>
                <td>
                    @if($profession->postGrad == 1)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-danger">Deactivate</span>
                    @endif
                </td>
                <td>{{$profession->job_created}}</td>
                <td>{{$profession->job_deadline}}</td>
                <td>
                    @if($profession->status == 1)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-danger">Deactivate</span>
                    @endif
                </td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$profession->id}}"></i>
                        <i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$profession->id}}"></i>
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
        var profession_id = $(this).data('id');
        $.get(sendUrl + '/' + profession_id, function (data) {
            $('#profession_id').val(data.id);
            $('#name').val(data.name);
            $('#ssc').val(data.ssc);
            $('#hsc').val(data.hsc);
            $('#grad').val(data.grad);
            $('#postGrad').val(data.postGrad);
            $('#status').val(data.status);
            $('#btn-save').val("update");
        });
    });
    $('.delete-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        var profession_id = $(this).data('id');
        var swalTitle = getSwalTitle();
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + profession_id,
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