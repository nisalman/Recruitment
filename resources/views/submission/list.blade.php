<div>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th>#</th>
            <th>@lang('application.applicant_name')</th>
            <th>@lang('application.applicant_mobile')</th>
            <th>ট্র্যাকিং নাম্বার</th>
            <th>@lang('application.priority')</th>
            <th>@lang('application.sports_name')</th>
            <th>@lang('application.sports_type')</th>
            <th>@lang('application.Annual Income')</th>
            <th>@lang('application.app_current_status')</th>
            <th style="text-align: center;width: 100px;">@lang('default.action')</th>
        </tr>

        </thead>
        <tbody>
        @foreach($forms as $form)
            <tr>
                <td>{{ $form->id }}</td>
                <td>{{ $form->name }}</td>
                <td>{{ toEnglish($form->mobile) }}</td>
                <td>{{ toEnglish($form->trackingNumber) }}</td>
                <td>{{ toBangla($form->rating) }}</td>
                <td>{{ $form->sport_name }}</td>
                <td>@if($form->player_name)
                        {{ $form->player_name }}
                    @else
                        প্রযোজ্য নয়
                    @endif
                </td>
                <td>{{ toBangla($form->annualIncome) }}</td>
                <td>
                    @if(trim($form->status) == 1)
                        <span class="label label-xs label-info">@lang('application.dc_ministry')</span>
                    @elseif(trim($form->status) == 2)
                        <span class="label label-xs label-success">@lang('application.dc_bkkf')</span>
                    @elseif(trim($form->status) == 3)
                        <span class="label label-xs label-primary">@lang('application.dc_approve_mi')</span>
                    @elseif(trim($form->status) == 4)
                        <span class="label label-xs label-primary">@lang('application.dc_approve_bk')</span>
                    @else
                        <span class="label label-sm label-warning">@lang('application.dc_pending')</span>
                    @endif
                </td>
                <td>
                    <div class='showing'>
                        <i class='btn btn-default btn-sm fa fa-pencil edit-btn' data-id="{{$form->id}}"></i>
                        {{--<i class='btn btn-danger btn-sm fa fa-trash delete-btn' data-id="{{$form->id}}"></i>--}}
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
            $('#rating').val(data.rating);
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