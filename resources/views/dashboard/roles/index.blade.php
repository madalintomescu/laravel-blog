@extends('layouts.dashboard.base')
@section('pageTitle', 'Roles')

@section('content')
{{ Breadcrumbs::render('dashboard.roles.index') }}

<div class="container-fluid">

  <div class="d-flex justify-content-between mb-3">
    <h1 class="page-heading">Roles ({{ $rolesCount }})</h1>

    @can('manage roles')
    <div id="app">
      <modal title="New role" button-text="New role">
        <v-form inline-template route="/api/roles" success-message="Role created!">
          <form @submit.prevent="processForm">

            <div class="form-group">
              <label for="name">Name</label>

              <input type="text" name="name" id="name" v-model="inputs.name" v-validate="'required|max:200|unique:roles'" data-vv-validate-on="change" class="form-control" :class="{'is-invalid': errors.has('name') }">

              <span v-if="errors.has('name')" v-text="errors.first('name')" class="invalid-message"></span>
            </div>

            <div class="form-group">
              <label for="permissions">Permissions</label>

              <select2 name="permissions[]" id="permissions" v-model="inputs.permissions" multiple="multiple" :class="{'is-invalid': errors.has('permissions') }">
                @foreach ($permissions as $permission)
                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
              </select2>
            </div>

            <div class="form-group">
              <button nameclick="!loading" :disabled="errors.any() || loading" class="btn btn-primary float-right">
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
          <th scope="col">Permissions</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($roles as $role)

        <tr scope="row">

          <td>
            <a href="{{ route('dashboard.roles.show', $role->id) }}">
              {{ $role->name }}
            </a>
          </td>

          <td>
            @if ($role->permissions())
            @foreach ($role->permissions as $permission)
            <span class="badge badge-secondary">{{ $permission->name }}</span>
            @endforeach
            @else
            -
            @endif
          </td>

          <td>
            {{-- Edit --}}
            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-link btn-sm c-666 p-0" data-toggle="tooltip" data-placement="top" title="Edit">
              <span class="oi oi-pencil"></span>
            </a>

            {{-- Trash --}}
            <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" class="display-inline-block">
              @csrf
              @method('DELETE')

              <button type="submit" class="btn btn-link btn-sm c-666 p-0" data-toggle="tooltip" data-placement="top" title="Delete">
                <span class="oi oi-trash"></span>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
{{ $roles->links() }}

@endsection
