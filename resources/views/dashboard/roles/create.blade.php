@extends('layouts.dashboard.base')
@section('pageTitle', 'Add role')
@section('content')

{{ Breadcrumbs::render('dashboard.roles.create') }}

<div class="container-fluid">

    <h1 class="page-heading mb-3">New role</h1>

    <div class="row">
        <div class="col col-md-6 col-lg-4">
            <form action="{{ route('dashboard.roles.store') }}" method="POST">
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
                    <label for="permissions" class="custom-label">Permissions</label>

                    <select name="permissions[]" id="permissions" class="form-control" multiple="multiple">
                        @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}">
                            {{ $permission->name }}
                        </option>
                        @endforeach
                    </select>

                    @if ($errors->has('permissions'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('permissions') }}</strong>
                    </span>
                    @endif

                </div>

                <input type="submit" class="btn btn-primary" value="Add new role">

            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('#permissions').select2({
      placeholder: 'Choose permissions...'
  });
});
</script>
@endpush
@endsection
