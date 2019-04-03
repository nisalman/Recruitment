<div class="container">
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'sports-form']) !!}
    {{csrf_field()}}
    <div class="modal fade" id="sportsModal" role="dialog" aria-labelledby="sportsModalArea" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="sportsModalArea">Education Board</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Grade</label>
                        <input type="text" name="name" id="name" class="form-control" readonly>
                        <input type="hidden" name="exam_id" id="exam_id" value="0">
                    </div>
                    <div class="form-group">
                        <label for="aplus">Remarks</label>
                        <input type="text" name="remarks" id="remarks" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="a">Point</label>
                        <input type="text" name="point" id="point" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="aminus">Exam Type</label>
                        <input type="text" name="flag" id="flag"  class="form-control" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>