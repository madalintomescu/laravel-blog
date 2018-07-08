@extends('layouts.dashboard.base')
@section('pageTitle', 'Create category')
@section('content')

{{ Breadcrumbs::render('dashboard.categories.create') }}

<div class="container-fluid">
    <h1 class="page-heading">Create category</h1>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <form action="{{ route('dashboard.categories.store') }}" method="POST">
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
                    <label for="name" class="custom-label">Description</label>

                    <input type="text" name="description" id="description" class="form-control custom-form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">

                    @if ($errors->has('description'))
                    <span class="invalid-message">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>

                <input type="submit" class="btn btn-primary" value="Create">

            </form>
        </div>
    </div>
</div>
@endsection
