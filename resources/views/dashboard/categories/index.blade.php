@extends('layouts.dashboard.base')
@section('pageTitle', 'Categories')

@section('content')
{{ Breadcrumbs::render('dashboard.categories.index') }}

<div class="container-fluid">

  <div class="d-flex justify-content-between mb-3">
    <h1 class="page-heading">Categories ({{ $categoriesCount }})</h1>

    @can('manage posts')
    <div id="app">
      <modal title="New category" button-text="New category">
        <v-form inline-template route="/api/categories" success-message="Category created!">
          <form @submit.prevent="processForm">

            <div class="form-group">
              <label for="name">Name</label>

              <input type="text" name="name" id="name" v-model="inputs.name" v-validate="'required|max:200|unique:categories'" data-vv-validate-on="change" class="form-control" :class="{'is-invalid': errors.has('name') }">

              <span v-if="errors.has('name')" v-text="errors.first('name')" class="invalid-message"></span>
            </div>

            <div class="form-group">
              <label for="description">Description</label>

              <input type="text" name="description" id="description" v-model="inputs.description" class="form-control">
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

  <div class="table-container my-3 px-2 py-1 bg-white rounded box-shadow">
    <table class="table table-borderless fs-14 mb-0">

      <thead>
        <tr class="thead-row">
          <th scope="col">Name</th>
          <th scope="col">Slug</th>
          <th scope="col">Description</th>
          <th scope="col">Count</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>

      <tbody>

        @foreach ($categories as $category)
        <tr scope="row" class="post-row">

          <td>
            <a href="{{ route('categories.show', $category->slug) }}" class="font-weight-bold">
              {{ $category->name }}
            </a>
          </td>

          <td>
            <p>{{ $category->slug }}</p>
          </td>

          <td>
            <p>{{ $category->description }}</p>
          </td>

          <td>
            @if ($category->posts_count)
            <a href="{{ route('categories.show', $category->slug) }}">
              {{ $category->posts_count }}
            </a>
            @else
            -
            @endif
          </td>

          <td>
            {{-- Edit --}}
            <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-link btn-sm c-666 p-0" data-toggle="tooltip" data-placement="top" title="Edit">
              <span class="oi oi-pencil"></span>
            </a>

            {{-- Don't allow users to delete the default category --}}
            @if ($category->name !== App\Category::defaultCategory())

            {{-- Trash --}}
            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST" class="display-inline-block">
              @csrf
              @method('DELETE')

              <button type="submit" class="btn btn-link btn-sm c-666 p-0" data-toggle="tooltip" data-placement="top" title="Delete">
                <span class="oi oi-trash"></span>
              </button>
            </form>
            @endif
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>

  {{ $categories->links() }}

</div>
@endsection
