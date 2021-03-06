<div class="container">
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'sports-form']) !!}
    {{csrf_field()}}
    <div class="modal fade" id="sportsModal" role="dialog" aria-labelledby="sportsModalArea" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="sportsModalArea">Create New Job</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Center Name</label>
                        <input type="text" name="name" id="name" class="form-control" required="">
                        <input type="hidden" name="center_id" id="center_id" value="0">
                    </div>
                    <div class="form-group">
                        <label for="status">Number of Room</label>
                        <input type="text" name="num_room" id="num_room" class="form-control" required="">

                    </div>
                    <div class="form-group">
                        <label for="status">Location</label>
                        <input type="text" name="location" id="location" class="form-control" required="">
                    </div>

                    <div class="form-group">
                        <label for="status">Center Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Deactivate</option>
                        </select>
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