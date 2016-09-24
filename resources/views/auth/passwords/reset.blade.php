@extends('layouts.login')

@section('content')
<div class="form login_form">
    <section class="login_content">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}
             <h1>Reset Password</h1>
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ $email or old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Reset Password</button>
            </div>
        </form>
    </section>
</div>
@endsection
