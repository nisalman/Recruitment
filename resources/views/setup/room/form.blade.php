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
                        <select name="center_id" id="center_id" class="form-control" required="">
                            <option value="">---</option>
                            @foreach($centers as $center)
                                <option value="{{$center->id}}">{{$center->name}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="room_id" id="room_id" value="0" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Room Name</label>
                        <input type="text" name="name" id="name" class="form-control" >

                    </div>
                    <div class="form-group">
                        <label for="status">Sit Capacity</label>
                        <input type="text" name="capacity" id="capacity" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="status">Location</label>
                        <input type="text" name="location" id="location" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Floor</label>
                        <input type="text" name="floor" id="floor" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
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