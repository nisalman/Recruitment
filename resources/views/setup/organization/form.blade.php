<div class="container">
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'sports-form']) !!}
    {{csrf_field()}}
    <div class="modal fade" id="sportsModal" role="dialog" aria-labelledby="sportsModalArea" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="sportsModalArea"> সংস্থা নিবন্ধন</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">সংস্থা নাম</label>
                        <input type="text" name="name" id="name" class="form-control bn" required="">
                        <input type="hidden" name="organization_id" id="organization_id" value="0">
                    </div>
                    <div class="form-group">
                        <label for="name">প্রতিনিধি</label>
                        <input type="text" name="representative" id="representative" class="form-control bn" required="">
                        
                    </div>
                  
                    
                    <div class="form-group">
                        <label for="status">অবস্থা</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">সক্রিয়</option>
                            <option value="0">নিষ্ক্রিয়</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">সংরক্ষন করুন</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>