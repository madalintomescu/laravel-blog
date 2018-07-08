@extends('layouts.dashboard.base')
@section('pageTitle', 'Edit permission')
@section('content')

{{ Breadcrumbs::render('dashboard.permissions.edit', $permission)}}

<div class="container-fluid">
    <h4>Edit permission - {{ $permission->name }}</h4>

    <div class="row">
        <div class="col-6">

            <form action="{{ route('dashboard.permissions.update', $permission->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name" class="custom-label">Name</label>

                    <input type="text" name="name" id="name" class="form-control custom-form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $permission->name }}" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Update">
            </form>
        </div>
    </div>

</div>

@endsection
