@extends('layouts.dashboard.base')
@section('pageTitle', 'Permissions')

@section('content')
{{ Breadcrumbs::render('dashboard.permissions.index') }}

<div class="container-fluid">

  <div class="d-flex justify-content-between mb-3">
    <h1 class="page-heading">Permissions</h1>

    @can('manage permissions')
    <div id="app">
      <modal title="New permission" button-text="New permission">
        <v-form inline-template route="/api/permissions" success-message="Permission created!">
          <form @submit.prevent="processForm">

            <div class="form-group">
              <label for="name">Name</label>

              <input type="text" name="name" id="name" v-model="inputs.name" v-validate="'required|unique:permissions|max:200'" data-vv-validate-on="change" class="form-control" :class="{'is-invalid': errors.has('name') }">

              <span v-if="errors.has('name')" v-text="errors.first('name')" class="invalid-message"></span>
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
          <th scope="col">Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($permissions as $permission)
        <tr scope="row">

          <td>
            <p>{{ $permission->name }}</p>
          </td>

          <td>
            {{-- Edit --}}
            <a href="{{ route('dashboard.permissions.edit', $permission->id) }}" class="btn btn-link btn-sm c-666 p-0" data-toggle="tooltip" data-placement="top" title="Edit">
              <span class="oi oi-pencil"></span>
            </a>

            {{-- Trash --}}
            <form action="{{ route('dashboard.permissions.destroy', $permission->id) }}" method="POST" class="display-inline-block">
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

{{ $permissions->links() }}

@endsection
