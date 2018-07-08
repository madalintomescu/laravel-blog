@extends('layouts.dashboard.base')
@section('pageTitle', 'Comments')
@section('content')

{{ Breadcrumbs::render('dashboard.posts.index') }}

<div class="container-fluid mb-4">

    <h1 class="page-heading mb-4">Comments</h1>

    <a href="" class="text-muted fs-14">Published ({{ $commentsCount }})</a>

    <div class="my-2 px-2 py-1 bg-white rounded box-shadow">
        <table class="table table-borderless fs-14 mb-0">

          <thead>
            <tr class="thead-row">
                <th scope="col">Author</th>
                <th scope="col">Comment</th>
                <th scope="col">In response to</th>
                <th scope="col">Created</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        @if ($commentsCount)
        <tbody>

            @foreach ($comments as $comment)
            <tr scope="row">

                <td>
                    @if ($comment->user)
                    <a href="{{ route('users.show', $comment->user->id) }}">
                        {{ $comment->user->name }}
                    </a>
                    @else
                    <p>{{ $comment->name }}</p>
                    @endif
                </td>

                <td>
                    {{ str_limit($comment->body, 200) }}
                </td>

                <td>
                    <a href="{{ route('posts.show', $comment->post->slug) }}#comment-{{ $comment->id }}">
                        {{ $comment->post->title }}
                    </a>
                </td>

                <td>
                    <abbr title="{{ $comment->created_at }}">
                        {{ $comment->created_at->format('Y/m/d') }}
                    </abbr>
                </td>

                <td class="text-center">

                    {{-- Trash --}}
                    <form action="{{ route('dashboard.comments.destroy', $comment->id) }}" method="POST" class="inline">
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

@else
</table>
<p class="text-center">No comments</p>
@endif

{{ $comments->links() }}

</div>
@endsection
