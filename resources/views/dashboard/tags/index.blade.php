@extends('layouts.dashboard.base')
@section('pageTitle', 'Tags')
@section('content')

{{ Breadcrumbs::render('dashboard.tags.index') }}

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h1 class="page-heading">Tags ({{ $tagsCount }})</h1>

        <div>
            <a href="{{ route('dashboard.tags.create') }}" class="btn btn-primary btn-sm">New tag</a>
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

            @if (count($tags))
            <tbody>

                @foreach ($tags as $tag)
                <tr scope="row" class="post-row">
                    <td>
                        <a href="{{ route('tags.show', $tag->slug) }}" class="font-weight-bold">{{ $tag->name }}</a>
                    </td>

                    <td>{{ $tag->slug }}</td>

                    <td>{{ $tag->description ?? '-' }}</td>

                    <td>
                        @if ($tag->posts_count)
                        <a href="{{ route('tags.show', $tag->slug) }}">{{ $tag->posts_count }}</a>
                        @else
                        <span>-</span>
                        @endif
                    </td>

                    <td>
                        {{-- Edit --}}
                        <a href="{{ route('dashboard.tags.edit', $tag->id) }}" class="btn btn-link btn-sm c-666 p-0" data-toggle="tooltip" data-placement="top" title="Edit"><span class="oi oi-pencil"></span></a>

                        {{-- Trash --}}
                        <form action="{{ route('dashboard.tags.destroy', $tag->id) }}" method="POST" class="display-inline-block">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-link btn-sm c-666 p-0" data-toggle="tooltip" data-placement="top" title="Delete"><span class="oi oi-trash"></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $tags->links() }}

    @else
</tbody>
</table>
<p class="text-center">No tags</p>
@endif

</div>
@endsection
