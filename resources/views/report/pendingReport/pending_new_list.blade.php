<!--              end search            -->
<style type="text/css">
    body {
        font-family: solaiman-lipi;
    }
</style>

<?php
//        echo '<pre>';
//        print_r($records);
//        exit();
//?>
<div id="print_id">
    <h2 align="center" style="color: #3c8dbc">
        Pending List Report</h2>
    <table id="reportList" class="table table-hover report-table">
        <thead >
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Applied For</th>
            <th>Mobile</th>

            <th>District Name</th>
            <th>Quota</th>
            @role(['dc'])
            <th>Send Message</th>
            @endrole
            @role(['dc','nsc'])
            <th class="pending-status" style="text-align: center;width: 100px;">@lang('default.action')</th>
            @endrole

        </tr>
        </thead>
        <tbody>
        @foreach($records as $key => $record)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{ $record->applicant_name }}<input type="hidden" name="app_id[]" value="{{ $record->id }}" /></td>
                <td>{{ $record->appliedPosition }}</td>
                <td>{{ $record->mobile }}</td>

                <td>{{ $record->district_bn_name }}</td>
                <td>{{ $record->bankAccNo}}</td>
            </tr>
        @endforeach
        </tbody>
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

    } );
</script>

