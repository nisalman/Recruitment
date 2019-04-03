@extends('layouts.admin')
@section('content')
    <div class="container-narrow">
        <button id="btn-add" name="btn-add" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class='fa fa-plus'></i>পদবি নিবন্ধন</button>
        <div>
            @include('setup.designation.form')
        </div>
        <div class="list-container">
            @include('setup.designation.list')
        </div>
    </div>
    <script>
        $(document).ready(function () {
        $("#datatable").dataTable({"bPaginate": false, "order": []});
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
                var federationId = $('#federation_id').val();
                var type = "POST";
                console.log(federationId);
                if (parseInt(federationId) > 0){

                    type = "PUT";
                    sendUrl += '/' + federationId;
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
                            federationId ? 'Update has been successfully done' : 'Save has been successfully done',
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