@extends('layouts.admin')
@section('content')
    <div class="container-narrow">
        <button id="btn-add" name="btn-add" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class='fa fa-plus'></i> Add More</button>
        <div>
            @include('setup.clubs.form')
        </div>
        <div class="list-container">
            @include('setup.clubs.list')
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#datatable").dataTable({"bPaginate": false, "order": []});
            $('#btn-add').on('click', function(){
                $('#btn-save').val("add");
                $('#clubs-form').trigger("reset");
                $('#sportsModal').modal('show');
            });

            $("#clubs-form").on('submit', function (e) {
                e.preventDefault();
                var sendUrl = window.location.pathname;
                var formData = $(this).serialize();
                //[add=POST], [update=PUT]
                var clubId = $('#club_id').val();
                var type = "POST";
                if (parseInt(clubId) > 0){
                    type = "PUT";
                    sendUrl += '/' + clubId;
                }
                $.ajax({
                    type: type,
                    url: sendUrl,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        $('#clubs-form').trigger("reset");
                        $('#sportsModal').modal('hide');
                        swal(
                            'Sucess...',
                            clubId ? 'Update has been successfully done' : 'Save has been successfully done',
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