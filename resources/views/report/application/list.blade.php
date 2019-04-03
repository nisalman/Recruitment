<!--              end search            -->
<div id="print_id">
    <table id="example" class="table table-hover report-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th class="pending-status">Applied For</th>
            <th>Mobile</th>
            <th>@lang('application.district_name')</th>
            <th>Quota</th>
            <th>Departmental Candidate</th>
            <th class="pending-status">Current Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $key => $record)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{ $record->applicant_name}}</td>
                <td>{{ $record->appliedPosition }}</td>
                <td>{{ $record->mobile }}</td>
                @role(['ministry','bsc'])
                <td>{{ $record->district_bn_name }}</td>
                @endrole
                <td>{{ $record->bankAccNo }}</td>
                <td>{{ $record->bankBranch}}</td>

                @role(['dc','nsc'])
                <td class="pending-status">
                    @if(trim($record->status) == 1)
                        @lang('application.dc_ministry')
                    @elseif(trim($record->status) == 2)
                        @lang('application.dc_bkkf')
                    @elseif(trim($record->status) == 3)
                        @lang('application.dc_approve_mi')
                    @elseif(trim($record->status) == 4)
                        @lang('application.dc_approve_bk')
                    @else
                        @lang('application.dc_pending')
                    @endif
                </td>
                @endrole
                @role(['ministry','bsc'])
                <td>
                    @if(trim($record->status) == 1 || trim($record->status) == 2)
                        @lang('application.mb_not_approve')
                    @else
                        @lang('application.mb_approve')
                    @endif
                </td>
                @endrole
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="pagination-right">
    {{ $records->links() }}
</div>


