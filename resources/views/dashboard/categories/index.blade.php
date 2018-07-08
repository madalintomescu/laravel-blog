@extends('layouts.dashboard.base')
@section('pageTitle', 'Categories')

@section('content')

{{ Breadcrumbs::render('dashboard.categories.index') }}

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h1 class="page-heading">Categories ({{ $categoriesCount }})</h1>

        <div>
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-primary">New category</a>
        </div>
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
