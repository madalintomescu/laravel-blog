@extends('layouts.base')
@section('pageTitle', 'Reset password')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
        <div class="box-shadow border rounded my-5 p-3 text-center">
            <p class="font-weight-bold mb-4">{{ __('Reset Password') }}</p>

            <form method="POST" action="{{ route('password.request') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email" class="custom-label">{{ __('E-Mail Address') }}</label>

                    <input id="email" type="email" class="form-control custom-form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class="custom-label">{{ __('Password') }}</label>

                    <input id="password" type="password" class="form-control custom-form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="custom-label">{{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="form-control custom-form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
