<div>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>জেলার নাম(বাংলা)</th>
        
            <th>উপজেলা নাম(বাংলা)</th>
            <th>উপজেলা নাম(ইংরেজি)</th>
            <th style="width: 125px">সংশোধন/মুছুন</th>
        </tr>

        </thead>
        <tbody>
        @foreach($upazilas as $key => $upazila)
            <tr>
                <td>{{ toBangla($key+1) }}</td>
                <td>@if($upazila->district_name)
                        {{ $upazila->district_name }}
                    @else
                        প্রযোজ্য নয়
                    @endif
                </td>
                 
                  <td>{{ $upazila->bn_name }}</td>
                  <td>{{ $upazila->name }}</td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$upazila->id}}"></i>
                        <i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$upazila->id}}"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- <script type="text/javascript">
    $(document).ready(function() {
    $('#datatablee').DataTable();


    
  


} );
</script> -->



<script>
    $('.edit-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        $('#sports-form').trigger("reset");
        $('#sportsModal').modal('show');
        var upazila_id = $(this).data('id');
        $.get(sendUrl + '/' + upazila_id, function (data) {
            $('#upazila_id').val(data.id);
            $('#name').val(data.name);
            $('#bn_name').val(data.bn_name);

            $('#district_id').val(data.district_id);
          
            $('#btn-save').val("update");
        });
    });
    $('.delete-btn').on('click', function(){
        var sendUrl = window.location.pathname;
        var upazila_id = $(this).data('id');
        var swalTitle = getSwalTitle();
        swal(swalTitle).then(function () {
            $.ajax({
                url: sendUrl + '/' + upazila_id,
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