@extends('layouts.dashboard.base')
@section('pageTitle', 'Add user')
@section('content')

{{ Breadcrumbs::render('dashboard.users.create') }}

<div class="container-fluid">

    <h1 class="page-heading mb-3">Add new user</h1>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">

            <form action="{{ route('dashboard.users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name" class="custom-label">Name</label>

                    <input type="text" name="name" id="name" class="form-control custom-form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required>

                    @if ($errors->has('name'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email" class="custom-label">Email</label>

                    <input type="email" name="email" id="email" class="form-control custom-form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required>

                    @if ($errors->has('email'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="password" class="custom-label">Password</label>

                    <input type="password" name="password" id="password" class="form-control custom-form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>

                    @if ($errors->has('password'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="custom-label">Confirm password</label>

                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control custom-form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>

                    @if ($errors->has('password'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="roles" class="custom-label">Choose roles</label>

                    <select name="roles[]" id="roles" class="form-control" multiple required>
                        @foreach ($roles as $role)
                        <option value="{{ $role->name }}">
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>

                    @if ($errors->has('roles'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('roles') }}</strong>
                    </span>
                    @endif
                </div>

                <input type="submit" class="btn btn-primary mb-3" value="Create user">

            </form>

        </div>
    </div>
</div>

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $('#roles').select2({
    placeholder: 'Choose roles...'
});
</script>

@endpush
@endsection
