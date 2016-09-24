@extends('layouts.login')
@section('content')
<div class="form login_form">
    <section class="login_content">
        <form  role="form" method="POST" action="{{ url('/register') }}" data-toggle="validator" id="register-form">
            {{ csrf_field() }}
            <h1>Create Account</h1>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <input id="name" type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                <div class="help-block with-errors"></div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" placeholder="Password" class="form-control" name="password"  data-minlength="6"  required>
                <div class="help-block">Minimum of 6 characters</div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input id="password-confirm" type="password" placeholder="Re-type Password" class="form-control" name="password_confirmation" 
                data-match="#password" data-match-error="Whoops, these don't match" required>
                <div class="help-block with-errors"></div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit">Register</button>
            </div> 
            <div class="clearfix"></div>
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
                <p class="change_link">Already a member ? <a href="/login" class="to_register"> Log in </a> </p>
                <div class="clearfix"></div><br />
            </div>
        </form>
    </section>
</div>
@endsection

@push('footer.page.level.scripts')
    <script>
        $('#register-form').validator()
    </script>
@endpush
