@extends('layouts.admin')
@section('content')
    <div class="container-narrow">
        <div>
            @include('submission.form')
        </div>
        <div class="list-container">
            @include('submission.list')
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#datatable").dataTable({"bPaginate": true, "order": []});
            //display modal form for creating new task
            $('#btn-add').on('click', function(){
                $('#btn-save').val("add");
                $('#sports-form').trigger("reset");
                $('#sportsModal').modal('show');
            });

            $("#sports-form").on('submit', function (e) {
                e.preventDefault();
                var sendUrl = window.location.pathname;
                var formData = $(this).serialize();
                //[add=POST], [update=PUT]
                var sportsId = $('#sports_id').val();
                var type = "POST";
                if (parseInt(sportsId) > 0){
                    type = "PUT";
                    sendUrl += '/' + sportsId;
                }
                $.ajax({
                    type: type,
                    url: sendUrl,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        $('#sports-form').trigger("reset");
                        $('#sportsModal').modal('hide');
                        swal(
                            'Sucess...',
                            sportsId ? 'Update has been successfully done' : 'Save has been successfully done',
                            'success'
                        );
                        $.get(window.location.pathname).done(function (data) {
                            eval($('.list-container').html(data));
                            $("#datatable").dataTable({"bPaginate": false, "order": []});
                        }).fail(function () {
                            alert('Result could not be loaded.');
                        });
                    },
                    error: function (data) {
                        alert('Error! Something wrong');
                    }
                });
            });
        });
    </script>
@endsection