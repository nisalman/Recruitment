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
        Applicant List</h2>
    <table id="reportList" class="table table-hover report-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Applied For</th>
            <th>Mobile</th>
            <th>District Name</th>
            <th>Quota</th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $key => $record)
            <tr>
                <td>{{($key + 1)}}</td>
                <td>{{ $record->applicant_name }}</td>
                <td>{{ $record->sport_name }}</td>
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

        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = toBangla(i+1);
            } );
        } ).draw();
    } );
</script>

