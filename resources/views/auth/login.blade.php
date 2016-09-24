@extends('layouts.login')
@section('content')
<div class="form login_form">
    @include('vendor.flash.message')
    <section class="login_content">
        <form role="form" method="POST" action="{{ url('/login') }}" class="form" id="login-form" data-toggle="validator">
            {{ csrf_field() }}
            <h1>Login Form</h1>
            <div class="form-group{{ $errors->has('email') ? ' has-error error' : '' }}">
                <input id="email" type="email" class="form-control" name="email"  placeholder="Email" value="{{ old('email') }}"  required>
                <div class="help-block with-errors"></div>
                @if ($errors->has('email'))
                    <span class="help-block with-errors">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="help-block with-errors">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember Me</label>
                </div>
            </div><br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="btn btn-link reset_pass" style="margin-top: 0px !important;" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
            </div>
            <div class="or-box">
                <span class="or">OR</span>
                <div class="row">
                    <div class="col-md-6 row-block">
                        <a href="/social/redirect/facebook" class="btn btn-facebook btn-block">Facebook</a>
                    </div>
                    <div class="col-md-6 row-block">
                        <a href="/social/redirect/github" class="btn btn-google btn-block">GitHub</a>
                    </div>
                </div>
            </div>  
            <div class="separator">
                <p class="change_link">New to site?<a href="/register" class="to_register"> Create Account </a></p>
                <div class="clearfix"></div>
            </div>
        </form>
    </section>
</div>
@stop

@push('footer.page.level.scripts')
<script>
    $('#login-form').validator()
</script>
@endpush
