@extends('layouts.admin')
@section('content')

        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">@lang('Profile')</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" data-name="profile">
                	{{csrf_field()}}
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('Name')</label>

                    <div class="col-sm-8">
                      <input type="text" name="name" class="form-control bn" id="inputName" value="{{$user->name}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">@lang('Email')</label>

                    <div class="col-sm-8">
                      <input type="email" name="email" class="form-control"  value="{{$user->email}}"  id="inputEmail" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">@lang('Mobile')</label>

                    <div class="col-sm-8">
                      <input type="text" name="mobile"  class="form-control"  value="{{$user->mobile}}"  id="inputEmail" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail"  class="col-sm-2 control-label">@lang('Password')</label>

                    <div class="col-sm-8">
                      <input type="Password" name="password" class="form-control"  placeholder ="******"   id="inputEmail" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">@lang('Photo')</label>

                    <div class="col-sm-8">
                      <input type="file" name="avatar" class="form-control"  id="inputEmail" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                      <button type="submit" class="btn btn-danger pull-right">@lang("Submit")</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
   		 </div> 
@endSection