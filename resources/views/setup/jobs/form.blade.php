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
                        <label for="name">Post Name</label>
                        <input type="text" name="name" id="name" class="form-control" required="">
                        <input type="hidden" name="profession_id" id="profession_id" value="0">
                    </div>
                    <div class="form-group">
                        <label for="status">SSC</label>
                        <select name="ssc" id="ssc" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Deactivate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">HSC</label>
                        <select name="hsc" id="grad" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Deactivate</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Graduation</label>
                        <select name="grad" id="grad" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Deactivate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Post Graduation</label>
                        <select name="postGrad" id="postGrad" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Deactivate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Job Status</label>
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