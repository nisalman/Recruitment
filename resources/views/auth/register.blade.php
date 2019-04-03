@extends('layouts.web')

@section('content')
<h3>@lang('default.register')</h3>
<div class="col-md-12 panel">
    <div class="row panel-body">
        <div class="alert alert-info col-md-12">
            <center>
                <p>[Application form for Enlistment with BJMC as a Local Buyer of Jute Goods]</p>
                <p>***Fill up with Required information to complete registration process**</p>
            </center>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div>
                    <form class="form-horizontal original" method="POST" action="{{ route('register') }}" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           
                            <label for="name" class="col-md-4 control-label">@lang('default.name')<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Write Full name..." class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">@lang('default.mobile')<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="01XXXXXXXXX" required="">

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">@lang('auth.password')<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="@lang('auth.password')..." class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">@lang('auth.confirm_password')<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="@lang('auth.confirm_password')..." required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">@lang('auth.email')</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="@lang('auth.email') (Example@email.com)...">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group  {{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">@lang('auth.captcha')<span class="required">*</span></label>

                            <div class="col-md-6">
                                <div class="col-md-6" style="padding: 0">
                                {!!captcha_img()!!}
                                </div>
                                <div class="col-md-6">
                                    
                                <input id="password-confirm" placeholder="@lang('auth.captcha')..." type="text" class="form-control" name="captcha" required>
                                </div>

                                @if ($errors->has('captcha'))
                                    <span class="help-block col-md-12" style="padding: 0">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit"  class="btn btn-primary submit-btn">
                                    @lang('auth.registration')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
@endsection

