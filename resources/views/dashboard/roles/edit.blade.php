@extends('layouts.dashboard.base')
@section('pageTitle', 'Edit role')
@section('content')

{{ Breadcrumbs::render('dashboard.roles.edit', $role) }}

<div class="container-fluid">

    <h1 class="page-heading mb-3">Edit role - {{ $role->name }}</h1>

    <div class="row">
        <div class="col-6">
            <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name" class="custom-label">Name</label>

                    <input type="text" name="name" id="name" class="form-control custom-form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $role->name }}" required>

                    @if ($errors->has('name'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group">

                    <select name="permissions[]" id="permissions" multiple="multiple">
                        @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}" 
                            @if ($role->hasPermissionTo($permission->name))
                            selected
                            @endif
                            >
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

                <input type="submit" class="btn btn-primary" value="Update role">
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
