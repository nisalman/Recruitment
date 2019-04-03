
<!--          search            -->

    <div class="filter-container panel panel-primary">
        <div class="panel-heading" role="tab" id="headingOne">
            <div class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                    <span class="glyphicon glyphicon-search"></span> Search Panel
                </a>
            </div>
        </div>
        <fieldset class="fieldset">
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="height: 0px;">
                <div class="panel-body form-inline">
                	<form action="" method="post" id="form-search">
                		 {{ csrf_field()}}
                    @if ($searchBox['applicant_name_flag'])
                	<div class="form-group">
                       Applicant name <br>
              			<input type="text" name="applicant_name" class="form-control" placeholder=Applicant name" />
                    </div>
                    @endif
                    @if ($searchBox['applicant_mobile_flag'])
                    <div class="form-group">
                            Applicant Mobile <br>
                    	<input type="text" name="applicant_mobile" class="form-control" placeholder="Applicant Mobile">
                    </div>
                     @endif
{{--                     @if ($searchBox['district_list_flag'])
                    <div class="form-group">
                        District Name<br>
                        <select name="district_id" class="form-control">
                        	<option value="" selected="">--Select--</option>
                        	@foreach($searchBox['district_list'] as $district)
                        	<option value="{{ $district->id }}">{{ $district->name }}</option>
                        	@endforeach;
                        </select>
                    </div>
                    @endif--}}
                    @if ($searchBox['trackingNumber_flag'])
                    <div class="form-group">
                       Tracking Number <br>
                        <input type="text" name="tracking_number" class="form-control" placeholder="Tracking Number..." />
                    </div>
                    @endif
                    @if ($searchBox['sports_list_flag'])
                    <div class="form-group">
                        Job Post Name<br>
                        <select name="sport_id" class="form-control">
                        	<option value="" selected="">--Select--</option>
                        	@foreach($searchBox['sports_list'] as $sport)
                        	<option value="{{ $sport->id }}">{{ $sport->name }}</option>
                        	@endforeach;
                        </select>
                    </div>
                     @endif
                     @if ($searchBox['center_list_flag'])
                    <div class="form-group">
                        Center<br>
                        <select name="center_id" class="form-control">
                        	<option value="" selected="">--Select--</option>
                          @foreach($searchBox['center_list'] as $player_type)
                        	 <option value="{{ $player_type->id }}">{{ $player_type->name }}</option>
                          @endforeach;
                        </select>
                    </div>
                    @endif
                        @if ($searchBox['room_list_flag'])
                            <div class="form-group">
                                Room Name<br>
                                <select name="room_id" class="form-control">
                                    <option value="" selected="">--Select--</option>
                                    @foreach($searchBox['room_list'] as $player_type)
                                        <option value="{{ $player_type->id }}">{{ $player_type->name }}</option>
                                    @endforeach;
                                </select>
                            </div>
                        @endif
                    @if ($searchBox['app_status_flag'])
                    <div class="form-group">
                        Application Status<br>
                        <select name="app_status" class="form-control">
                            <option value="" selected="">--Select--</option>
                          @foreach($searchBox['app_status'] as $key => $row)
                             <option value="{{ $key }}">{{ $row }}</option>
                          @endforeach;
                        </select>
                    </div>
                    @endif

                    <div class="form-group">
                        Year<br>
                        <select name="year_id" class="form-control">
                            @foreach($searchBox['year'] as $obj)
                                <option value="{{ $obj->id }}" {{$obj->status == 1 ? ' selected=selected ' : ''}}>{{ $obj->year_name }}</option>
                            @endforeach;
                        </select>
                    </div>

                  	{{--<div class="form-group">
                        Row / Page<br>
                        <select name="per_page" class="form-control">
                        	<option value="15">{{ 15 }}</option>
                            <option value="25">{{ 25 }}</option>
                            <option selected value="50">{{ 50 }}</option>
                            <option value="100">{{ 100 }}</option>
                            <option value="250">{{ 250 }}</option>
                            <option value="500">{{ 500}}</option>
                        </select>
                    </div>--}}
                
                    <div class="form-group mar"><br>
                        <button type="submit" id="search" class="btn btn-primary pull-right btn-xs">&nbsp;Search</button>
                    </div>
                </form>
                </div>
            </div>
        </fieldset>
    </div>

<!--              end search            -->


