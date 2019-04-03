@include('form-modal')
<!--              end search            -->

<div id="print_id">
    @role(['bsc','ministry'])

    @if($segment=Request::segment(2)== 'get-total-application')

        <div class="hiddenn" style=" text-align: center; border-color: blue"><h3><strong>@lang('application.application_all_list')</strong></h3>
        </div>

    @else
        <div class="hiddenn" style=" text-align: center; border-color: blue"><h3><strong>@lang('application.application_list')</strong></h3>
        </div>
    @endif
    @endrole
    @role(['dc','nsc'])
    <div class="hiddenn" style=" text-align: center; border-color: blue"><h3><strong>@lang('application.application_list')</strong></h3>
    </div>
    @endrole


    <div class="col-md-12 c-wrapper">
        <table id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Applied For</th>
                <th>Mobile</th>
                <th>Quota</th>
                <th>Departmental Candidate</th>
                <th class="pending-status">Current Status</th>
                <th  class="status" style="text-align: center;width: 42px;">@lang('default.action')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($records as $key => $record)
                <tr>
                    <td>{{($key + 1)}}</td>
                    <td>{{ $record->applicant_name}}</td>
                    <td>{{ $record->sport_name }}</td>
                    <td>{{ $record->mobile }}</td>
                    <td>{{ $record->bankAccNo }}</td>
                    <td>{{ $record->bankBranch}}</td>
                    <td class="pending-status">
                        @if(trim($record->status) == 1)
                            <span class="label label-xs label-info">@lang('application.dc_ministry')</span>
                        @elseif(trim($record->status) == 2)
                            <span class="label label-xs label-success">@lang('application.dc_bkkf')</span>
                        @elseif(trim($record->status) == 3)
                            <span class="label label-xs label-primary">@lang('application.dc_approve_mi')</span>
                        @elseif(trim($record->status) == 4)
                            <span class="label label-xs label-primary">@lang('application.dc_approve_bk')</span>
                        @else
                            <span class="label label-xs label-warning">@lang('application.dc_pending')</span>
                        @endif
                    </td>
                    <td  class="status"><div class=""><i onclick="showForm1({{ $record->id }})" class="btn btn-default btn-sm fa fa-eye"></i></div></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
{{--<div class="pagination-center">--}}
    {{--{{ $records->links() }}--}}
{{--</div>--}}
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        //window.close();
    }

    $(document).on('click', '#show-form  button.close', function(){
        $('.modal-backdrop').hide();
        $('#show-form').hide();
        //console.log('fgd');
        location.reload();
    });

    $(document).ready( function () {
        $('#myTable').DataTable({
            "aLengthMenu": [[10, 25, 50, 75,100, 1000, -1], [10, 25, 50, 75, 100, 1000, "All"]],
            "iDisplayLength": 10
        })
    } );

</script>


