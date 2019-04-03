<div class="container">
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'sports-form']) !!}
    {{csrf_field()}}
    <div class="modal fade" id="sportsModal" role="dialog" aria-labelledby="sportsModalArea" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="sportsModalArea"> উপজেলা নিবন্ধন</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status">জেলার নাম</label>
                        <select name="district_id" id="district_id" class="form-control">
                            <option value="">--</option>
                            @foreach(\App\District::all() as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">উপজেলা নাম(ইংরেজি)</label>
                        <input type="text" name="name" id="name" class="form-control" required="">
                        <input type="hidden" name="upazila_id" id="upazila_id" value="0">
                    </div>
                       <div class="form-group">
                        <label for="name">উপজেলা নাম(বাংলা)</label>
                        <input type="text" name="bn_name" id="bn_name" class="form-control bn" required="">
                        <input type="hidden" name="upazila_id" id="upazila_id" value="0">
                    </div>
                  
                    <!--<div class="form-group">
                        <label for="status">অবস্থা</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">সক্রিয়</option>
                            <option value="0">নিষ্ক্রিয়</option>
                        </select>
                    </div>-->
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