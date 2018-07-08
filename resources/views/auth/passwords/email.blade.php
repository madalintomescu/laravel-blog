@extends('layouts.base')
@section('pageTitle', 'Reset password')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
        <div class="box-shadow border rounded my-5 p-3 text-center">
            <p class="font-weight-bold mb-4">{{ __('Reset Password') }}</p>

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="custom-label">{{ __('E-Mail Address') }}</label>

                    <input id="email" type="email" class="form-control custom-form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
