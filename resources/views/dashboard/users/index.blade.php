@extends('layouts.dashboard.base')
@section('pageTitle', 'Users')

@section('content')
{{ Breadcrumbs::render('dashboard.users.index') }}

<div class="container-fluid">

  <div class="d-flex justify-content-between mb-3">
    <h1 class="page-heading">Users</h1>

    @can('manage users')
    <div id="app">
      <modal title="New user" button-text="New user">
        <v-form inline-template route="/api/users" success-message="User created!">
          <form @submit.prevent="processForm">

            <div class="form-group">
              <label for="name">Name</label>

              <input type="text" name="name" id="name" v-model="inputs.name" v-validate="'required|max:200'" class="form-control" :class="{'is-invalid': errors.has('name') }">

              <span v-if="errors.has('name')" v-text="errors.first('name')" class="invalid-message"></span>
            </div>

            <div class="form-group">
              <label for="email">Email</label>

              <input type="email" name="email" id="email" v-model="inputs.email" v-validate="'required|email|unique:email|max:255'" data-vv-validate-on="change" class="form-control" :class="{'is-invalid': errors.has('email')}">

              <span v-if="errors.has('email')" v-text="errors.first('email')" class="invalid-message"></span>
            </div>

            <div class="form-group">
              <label for="password">Password</label>

              <input type="password" name="password" id="password" v-model="inputs.password" v-validate="'required'" ref="password" class="form-control" :class="{'is-invalid': errors.has('password')}">

              <span v-if="errors.has('password')" v-text="errors.first('password')" class="invalid-message"></span>
            </div>

            <div class="form-group">
              <label for="password_confirmation">Confirm password</label>

              <input type="password" name="password_confirmation" id="password_confirmation" v-model="inputs.password_confirmation" v-validate="'required|confirmed:password'" data-vv-as="password" class="form-control" :class="{'is-invalid': errors.has('password_confirmation')}">

              <span v-if="errors.has('password_confirmation')" v-text="errors.first('password_confirmation')" class="invalid-message"></span>
            </div>

            <div class="form-group">
              <label for="roles">Roles</label>


              <select2 name="roles[]" id="roles" v-model="inputs.roles" multiple="multiple" class="form-control" :class="{'is-invalid': errors.has('roles')}">
                @foreach ($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
              </select2>
            </div>

            <div class="form-group">
              <button @click="!loading" :disabled="errors.any() || loading" class="btn btn-primary float-right">
                <fa-icon v-if="loading" icon="spinner" spin></fa-icon> Create
              </button>
            </div>

          </form>
        </v-form>
      </modal>
    </div>
    @endcan
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
