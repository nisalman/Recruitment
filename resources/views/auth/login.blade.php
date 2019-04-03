@extends('layouts.web')

@section('content')

<h3>@lang('auth.login_name')</h3>
<div class="col-md-12 panel">
    <div class="row panel-body">
        <div class="alert alert-info col-md-12">
            <center>
                <p>Login for existing user</p>
                <p>If you don't Registered yet, Please  <a href="/register">Click here </a></p>
            </center>
        </div>

        <div>
                    <form class="form-horizontal original" method="POST" action="{{ route('login') }}" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}{{ $errors->has('mobile') ? ' has-error' : '' }}{{ $errors->has('email') ? ' has-error' : '' }}{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-5 control-label">@lang('auth.user_name')</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" placeholder="@lang('auth.user_name')..." name="username" value="{{ old('username') }}{{ old('mobile') }}{{ old('email') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-5 control-label">@lang('auth.password')</label>

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
                            <div class="col-md-5"></div>
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-5"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.login')
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
    </div>
</div>
@endsection
