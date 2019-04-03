<!--              end search            -->
<style type="text/css">
    body {
        font-family: solaiman-lipi;
    }
</style>

<div id="print_id">
    <h2 align="center" style="color: #3c8dbc">
        বঙ্গবন্ধু ক্রীড়াসেবী কল্যাণ ফাউন্ডেশন</h2>
    <table id="reportList" class="table table-hover report-table">
        <thead>
        <tr>
            <th>#</th>
            <th>@lang('application.applicant_name')</th>
            <th>@lang('application.applicant_mobile')</th>
            <th class="pending-status">@lang('application.priority')</th>
            <th>@lang('application.district_name')</th>
            <th>@lang('application.sports_name')</th>
            <th>@lang('application.sports_type')</th>
            <th>@lang('application.Annual Income')</th>
            <th >মন্তব্য                            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($records as $key => $record)
            <tr>
                <td>{{($key + 1)}}</td>
                <td>{{ $record->applicant_name }}</td>
                <td>{{ toBangla($record->mobile) }}</td>
                <td class="pending-status">{{ toBangla($record->rating) }}</td>
                <td>{{ $record->district_bn_name }}</td>
                <td>{{ $record->sport_name }}</td>
                <td>{{ $record->player_type }}</td>
                <td>{{ $record->annual_income }}</td>
                <td></td>
                </tr>
        @endforeach
    </table>
</div>
<script>
    $(document).ready( function () {

        var t = $('#reportList').DataTable( {
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]],
            paging: false,
            colReorder: false,

        } );

        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = toBangla(i+1);
            } );
        } ).draw();
    } );
</script>

