<!--              end search            -->
<div id="print_id">
    <style>
        .letter{
            display: none;
        }
        .letter-table{
            display: none;
        }

        @media print {
            .letter{
                display: block;
            }
            .letter-table{
                display: block;
            }
            .table{
                border-collapse: collapse;
                width: 100%;
                color:red;
            }
            #example{
            display: none;
                         }
        }
    </style>
    <span class="letter">
        বরাবর<br>
        <span>
            &nbsp &nbsp &nbsp &nbsp সচিব<br>
            &nbsp &nbsp &nbsp &nbsp বঙ্গবন্ধু ক্রীড়া সেবী কল্যাণ ফাউন্ডেশন<br>
            &nbsp &nbsp &nbsp &nbsp যুব ও ক্রীড়া মন্ত্রণালয়<br>
            &nbsp &nbsp &nbsp &nbsp সচিবালয়, ঢাকা-১২০৯<br>
        </span>
        {{--<span>--}}
            {{--&nbsp &nbsp &nbsp &nbsp সচিব<br>--}}
            {{--&nbsp &nbsp &nbsp &nbsp যুব ও ক্রীড়া মন্ত্রণালয়<br>--}}
            {{--&nbsp &nbsp &nbsp &nbsp সচিবালয়, ঢাকা-১২০৯<br>--}}
        {{--</span>--}}
        <br>
        <b>বিষয়ঃ</b> ক্রমানুসরে অগ্রাধিকারের ভিত্তিতে খেলোয়াড়/ক্রীড়া সংগঠকদের অনুদানের জন্য আবেদন পত্র প্রেরণ।
        <br><br><br>
        জনাব, <br>
        &nbsp &nbsp &nbsp &nbsp উপরোক্ত বিষয়ের আলোকে জানানো যাচ্ছে যে, আর্থিকভাবে অসচ্ছল ক্রীড়াবিদ ও ক্রীড়া সংগঠকদের কল্যাণ অনুদান/এককালীন অনুদান এর বাছাইকৃত আবেদনকারীদের নাম নিম্নে তালিকা সহ সদয় অবগতির জন্য প্রেরণ করা হল

        <br><br><br>
        <p>অগ্রাধিকারের ভিত্তিতে বাছাইকৃত আবেদনকারীদের নামঃ</p>
    </span>
    <span class="letter-table">

        <table class="table report-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('application.applicant_name')</th>
                <th>@lang('application.applicant_mobile')</th>
                <th>@lang('application.sports_name')</th>
                <th>@lang('application.sports_type')</th>
                <th>@lang('application.priority')</th>
            </tr>
            </thead>
            <tbody>
        @foreach($records as $key => $record)
            <tr>
                <td>{{ toBangla($key + 1)}}</td>
                <td>{{ $record->applicant_name }}</td>
                <td>{{ toBangla($record->mobile) }}</td>
                <td>{{ $record->sport_name }}</td>
                <td>{{ $record->player_type }}</td>
                <td>{{ toBangla($record->rating) }}</td>

            </tr>
        @endforeach
        </tbody>
        </table>
<br><br><br>
        <table>
            <thead>
            <tr>
                <td style="width: 350px"; align="center">জেলা প্রশাসক <br>
            @foreach($records->slice(0,1) as $record)
                {{ $record->district_bn_name }}</td>

                @endforeach


                <td style="width: 350px"; align="center">জেলা ক্রীড়া অফিসার <br>
                    @foreach($records->slice(0,1) as $record)
                        {{ $record->district_bn_name }}</td>

                @endforeach
            </tr>
            </thead>
        </table>
    </span>
    <table id="example" class="table table-hover report-table">
        <thead>
        <tr>
            <th>#</th>
            <th>@lang('application.applicant_name')</th>
            <th>ছবি</th>
            <th>@lang('application.applicant_mobile')</th>
            <th>@lang('application.priority')</th>
            @role(['ministry','bsc'])
            <th>@lang('application.district_name')</th>
            @endrole
            <th>@lang('application.sports_name')</th>
            <th>@lang('application.sports_type')</th>
            <th>@lang('application.Annual Income')</th>
            <th>@lang('application.app_current_status')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $key => $record)
            <tr>
                <td>{{ toBangla($key + 1)}}</td>
                <td>{{ $record->applicant_name }}</td>
                <td><img src="{{asset($record->photo)}}" class="zoom"></td>
                <td>{{ toBangla($record->mobile) }}</td>
                <td>{{ toBangla($record->rating) }}</td>
                @role(['ministry','bsc'])
                <td>{{ $record->district_bn_name }}</td>
                @endrole
                <td>{{ $record->sport_name }}</td>
                <td>{{ $record->player_type }}</td>
                <td>{{ $record->annual_income }}</td>
                @role(['dc'])
                <td>
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


