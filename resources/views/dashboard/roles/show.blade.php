@extends('layouts.dashboard.base')
@section('pageTitle', 'Roles')

@section('content')

{{ Breadcrumbs::render('dashboard.roles.show', $role) }}

<div class="container-fluid">
    <div class="box-shadow rounded bg-white p-3">
        <h1 class="page-heading mb-4">{{ $role->name }}</h1>

        <p>Permissions</p>
        <ul class="list-unstyled">
            @forelse ($permissions as $permission)
            <div class="badge badge-light">{{ $permission->name }}</div>
            @empty
            <p>This role doesn't have any permissions.</p>
            @endforelse
        </ul>

    </div>
</div>

@endsection
