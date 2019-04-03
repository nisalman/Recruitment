<div class="container">
    <div class="text-center">
        <h3><small>Send Message to Buyer for Changes</small></h3>
        {!! Form::open(['url' => 'admin/application-pending/send-message', 'method' => 'post']) !!}
        {!! Form::hidden('id', $id) !!}
        {!! Form::textarea('mes', '',['col'=>'35', 'row'=>'5']) !!}<br>
        {!! Form::submit('Send Message', ['class'=>'btn btn-info btn-sm']) !!}
        {!! Form::close() !!}

    </div>

</div>