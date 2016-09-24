@extends('layouts.login')

<!-- Main Content -->
@section('content')
<div class="form login_form">
    <section class="login_content">
        @include('vendor.flash.message')
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                <h1>Reset Password</h1>
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" placeholder="Email"  name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                </div>
            </form>
    </section>
</div>      
@endsection
