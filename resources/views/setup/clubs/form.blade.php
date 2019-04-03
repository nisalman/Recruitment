<div class="container">
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'clubs-form']) !!}
    {{csrf_field()}}
    <div class="modal fade" id="sportsModal" role="dialog" aria-labelledby="sportsModalArea" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="sportsModalArea">Settings Mode</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Image Type</label>
                        <input type="text" name="name" id="name" class="form-control" required="" readonly>
                        <input type="hidden" name="club_id" id="club_id" value="0">
                    </div>
                    <div class="form-group">
                        <label for="status">Image Size (KB)</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Height</label>
                        <input type="text" name="height" id="height" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Width</label>
                        <input type="text" name="width" id="width" class="form-control" required>
                    </div>

                    {{--                    <div class="form-group">
                                            <label for="status">অবস্থা</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">সক্রিয়</option>
                                                <option value="0">নিষ্ক্রিয়</option>
                                            </select>
                                        </div>--}}
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