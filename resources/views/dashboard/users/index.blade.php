@extends('layouts.dashboard.base')
@section('pageTitle', 'Users')
@section('content')

{{ Breadcrumbs::render('dashboard.users.index') }}

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h1 class="page-heading">Users</h1>

        <div>
            <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary btn-sm">New user</a>
        </div>
    </div>

    <div class="my-3 px-2 py-1 bg-white rounded box-shadow">
        <table class="table table-borderless fs-14 mb-0">

            <thead>
                <tr class="thead-row">
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Registered</th>
                    <th scope="col">Role</th>
                    <th scope="col">Posts</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($users as $user)
                <tr scope="row">

                    <td>
                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" style="width: 35px; height: 35px;">
                        <a href="{{ route('users.show', $user->id) }}">
                            {{ $user->name }}
                        </a>
                    </td>

                    <td>{{ $user->email }}</td>

                    <td>
                        <abbr title="{{ $user->created_at }}">
                            {{ $user->created_at->format('Y/m/d') }}
                        </abbr>
                    </td>

                    <td>
                        @foreach ($user->roles->pluck('name') as $role)
                        {{ $role }}@if (!$loop->last), @endif
                        @endforeach
                    </td>

                    <td>{{ $user->posts_count }}</td>

                    <td>
                        {{-- Edit --}}
                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-link btn-sm c-666 p-0" data-toggle="tooltip" data-placement="top" title="Edit">

                            <span class="oi oi-pencil"></span>
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" class="display-inline-block">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-link btn-sm c-666 p-0" data-toggle="tooltip" data-placement="top" title="Delete">
                                <span class="oi oi-trash"></span>
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}

</div>
@endsection
