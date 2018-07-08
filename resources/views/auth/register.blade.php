@extends('layouts.base')
@section('pageTitle', 'Register')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
        <div class="box-shadow border rounded my-5 p-3 text-center">
            <p class="font-weight-bold mb-4">{{ __('Register') }}</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="custom-label">{{ __('Name') }}</label>

                    <input id="name" type="text" class="form-control custom-form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email" class="custom-label">{{ __('E-Mail Address') }}</label>

                    <input id="email" type="email" class="form-control custom-form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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

                    <input id="password-confirm" type="password" class="form-control custom-form-control" name="password_confirmation" required>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
