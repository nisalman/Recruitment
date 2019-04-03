<div class="container">
    {!! Form::open(['class' => 'se-form', 'id' => 'sports-form']) !!}
    {{csrf_field()}}
    <div class="modal fade" id="sportsModal" role="dialog" aria-labelledby="sportsModalArea" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="sportsModalArea"> স্পেশাল আবেদনকারী</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">আবেদনকারীর নাম</label>
                        <input type="text" name="name" readonly="" id="name" class="form-control bn" required="">
                        <input type="hidden" name="sports_id" id="sports_id" value="0">
                    </div>
                    <div class="form-group">
                        <label for="status">অগ্রাধিকার</label>
                        <input type="number" name="rating" id="rating" required class="form-control">
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