@extends('layouts.admin')

@section('content')


    <form action="" method="post" id="update_marks">
        {{ csrf_field()}}
        <div align="right">
            <button type="submit" class="btn btn-success">Update</button>
            <br><br>
        </div>

        <table id="example" class="table table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Tracking Number</th>
                <th>Name</th>
                <th style="width: 100px;">Preliminary Marks
                    <input id="pr" type="checkbox"/>
                </th>
                <th style="width: 100px;">Written Marks <br>
                    <input id="wr" type="checkbox"/></th>
                <th style="width: 100px;">Viva Marks <br> <input id="vi" type="checkbox"/></th>
                <th style="width: 100px;">Total Marks</th>


            </tr>
            </thead>
           {{-- @php
            dd($records);
            @endphp--}}
            <tbody><?php $sl = 1; ?>
            @foreach($records as $record)

                <tr class="row_select">
                    <td><?php echo $sl++;?></td>
                    <td>{{$record->trackingNumber}}</td>
                    <td>{{$record->applicant_name}}</td>
                    <td><input type="number" class="form-control pr" name="pr[{{$record->mark_id}}][]"
                               value="{{$record->preli}}"></td>
                    <td><input type="number" class="form-control wr" name="wr[{{$record->mark_id}}][]"
                               value="{{$record->written}}"></td>
                    <td><input type="number" class="form-control vi" name="vi[{{$record->mark_id}}][]"
                               value="{{$record->viva}}"></td>

                    <td><input type="text" class="form-control tot" name="tot[{{$record->mark_id}}][]" value="{{($record->preli+$record->written+$record->viva) == 0 ? '': ($record->preli+$record->written+$record->viva)}}" readonly></td>

                    {{--
                             <td><input type="text" class="form-control bn" value="{{$record->app_limit}}" name="app_limit[]"><input type="hidden" class="form-control" value="{{$record->id}}" name="district_id[]"></td>
                    --}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
    <script>
        // this code for working pageniation
        //source  datatable third party plugins.
        $(document).ready(function () {
            $('.pr, .wr, .vi').attr('readonly', true);
            var table = $('#example').DataTable({
                "lengthMenu": [[2, 4, 8, -1], [2, 4, 8, "All"]],
                "pageLength": 15

            });
            $('input[type="checkbox"]').click(function () {
                var x = $(this).attr('id');

                if ($('#' + x).prop("checked") === true) {
                    $('.' + x).attr('readonly', false);
                } else if ($('#' + x).prop("checked") === false) {
                    $('.' + x).attr('readonly', true);
                }
            });


            table.columns().every(function () {

                /* var data = this.data();
                 $('input[type="checkbox"]').click(function(){
                     if($(this).prop("checked") == true){
                         alert("Checkbox is checked.");
                     }
                     else if($(this).prop("checked") == false){
                         alert("Checkbox is unchecked.");
                     }
                 });*/
                // ... do something with data(), or this.nodes(), etc
            });
        });


    </script>


    <script type="text/javascript">
        $(document).on('click', 'button[type="submit"]', function (e) {
            e.preventDefault();
            var sendData = $("#update_marks").serialize();
            var targetUrl = "/admin/district-update";

            var selector = {1: 'pr', 2: 'wr', 3: 'vi'};

            /*if(input[type="checkbox"].props('checked')){

            }*/
            $.ajax({
                url: targetUrl,
                type: "POST",
                data: sendData,
                dataType: "json",
                success: function (response) {
                    //window.location.reload();
                    if (response.type) {
                        window.location.reload();

                    }
                    console.log(response);

                }, error: function (jqXHR) {
                    console.log(jqXHR);
                }
            });
        });
    </script>
    <script type="application/javascript">
        $(document).ready(function () {
            var x =[];
            $('.row_select').each(function () {
                x = $(this).find('.pr').val();
               // x.reload(true);
                console.log(x);
            })
        })
    </script>


@endsection