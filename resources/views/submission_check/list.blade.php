<div>
    <table class="table table-bordered report-table" id="datatable">
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
        </tr>
        </thead>
        <tbody>
        @foreach($forms as $key => $form)
            <tr>
                <td>{{ $key + 1 }}</td>
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
                    @if(trim($form->status) == 5)
                        <span class="label label-xs label-info">বিশেষ</span>

                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>