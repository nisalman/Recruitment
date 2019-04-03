<div class="container">
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'sports-form']) !!}
    {{csrf_field()}}
    <div class="modal fade" id="sportsModal" role="dialog" aria-labelledby="sportsModalArea" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="sportsModalArea"> খেলা নিবন্ধন</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">খেলার নাম</label>
                        <input type="text" name="name" id="name" class="form-control bn" required="">
                        <input type="hidden" name="sports_id" id="sports_id" value="0">
                        <input type="hidden" name="is_federation" id="is_federation" value="">
                        <input type="hidden" name="is_association" id="is_association" value="">
                    </div>
                    <div class="form-group">
                        <label for="status">অবস্থা</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">সক্রিয়</option>
                            <option value="0">নিষ্ক্রিয়</option>
                        </select>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="on" name="federation" id="federation">ফেডারেশন</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="on" name="association" id="association">এসোসিয়েশন</label>
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