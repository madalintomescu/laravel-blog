@extends('layouts.base')
@section('pageTitle', $post->title)

@section('content')

<div class="row">

    <div class="col-12 col-lg-8">

        <article>

            @if ($post->image)
            <img src="{{ asset('storage/post/' . $post->image) }}" class="img-fluid">
            @endif

            <h1>
                <a class="post-title" href="{{ route('posts.show', $post->id) }}">
                    {{ $post->title}}
                </a>
            </h1>

            <div class="post-meta fs-14">

                <span class="mr-2">
                    {{ $post->created_at->diffForHumans() }}
                </span>

                <span class="separator">/</span>

                <a href="{{ route('users.show', $post->user->id) }}" class="mx-2">
                    {{ $post->user->name }}
                </a>

                <span class="separator">/</span>

                Posted in: 

                @foreach ($post->categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}">
                    {{ $category->name }}@if (!$loop->last),@endif
                </a>
                @endforeach

                <span class="separator">/</span>

                <a href="{{ route('posts.show', $post->slug) }}#comments" class="mx-2">
                    {{ $post->comments_count }} <span class="oi oi-chat"></span>
                </a>

                @can('manage', $post)

                {{-- Edit post --}}
                <a href="{{ route('dashboard.posts.edit', $post->id) }}" class="mx-2" data-toggle="tooltip" data-placement="top" title="Edit">
                    <span class="oi oi-pencil"></span>
                </a>

                {{-- Move to trash --}}
                <a href="#" class="mx-2" data-toggle="modal" data-target="#deletePostModal">
                    <span class="oi oi-trash" data-toggle="tooltip" data-placement="top" title="Move to trash"></span>
                </a>

                {{-- Modal --}}
                <div class="modal post-modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel" aria-hidden="true">
                    <div class="modal-dialog h-100 d-flex flex-column justify-content-center my-0" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePostModalLabel">Move to trash</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>

                            <div class="modal-body">
                                The post will be moved to trash.
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-sm modal-button" data-dismiss="modal">Cancel</button>

                                <form action="{{ route('posts.destroy', $post->id)}}" class="delete-form" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm modal-button" type="submit" name="form_post_delete">Delete</button>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                @endcan

            </div>

            {{-- Post body --}}
            <div class="post-body mt-3">
                {!! $post->body !!}
            </div>

            {{-- Post tags --}}
            @if (count($post->tags))
            <div class="mt-5">
                @foreach ($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}" class="tag">
                    {{ $tag->name }}
                </a>
                @endforeach
            </div>
            @endif

            {{-- Prev/Next posts --}}
            <div class="row mt-3">
                <div class="col">
                    @if ($previousPost)
                    <p class="text-muted fs-12 mb-0">Previous post</p>
                    <a href="{{ route('posts.show', $previousPost->slug) }}">
                        {{ $previousPost->title }}
                    </a>
                    @endif
                </div>
                <div class="col">
                    @if ($nextPost)
                    <div class="float-right">

                        <p class="text-muted fs-12 mb-0">Next post</p>
                        <a href="{{ route('posts.show', $nextPost->slug) }}" class="float-right">
                            {{ $nextPost->title }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>

        </article>

        <hr>

        {{-- Comments section --}}
        <div id="comments">

            <h5 class="my-4">
                {{ $post->comments_count }} {{ str_plural('comment', $post->comments_count) }}
            </h5>

            @foreach ($comments as $comment)

            <div class="media mb-3" id="comment-{{ $comment->id }}">

              {{-- Comment avatar --}}
              @if ($comment->user_id)
              <img src="{{ asset('storage/avatars/' . $comment->user->avatar) }}" class="comment-img img-fluid mr-3">
              @else
              <img src="{{ asset('storage/avatars/' . App\User::DEFAULT_AVATAR) }}" class="comment-img img-fluid mr-3">
              @endif

              <div class="media-body">

                {{-- Comment author name --}}
                @if ($comment->user_id)
                <a href="{{ route('users.show', $comment->user->id) }}" class="c-444 font-weight-bold mb-0">
                    {{ $comment->user->name }}
                </a>
                @else
                <p class="mb-0">{{ $comment->name }}</p>
                @endif

                {{-- Comment date --}}
                <a href="{{ url()->current() }}#comment-{{ $comment->id }}" class="fs-12 c-777 display-block">
                    {{ $comment->created_at->diffForHumans() }}
                </a>

                {{-- Comment body --}}
                <p class="fs-14 c-444 mt-1">{{ $comment->body }}</p>

            </div>
        </div>
        @endforeach

        {{ $comments->links() }}

        {{-- Comment form --}}
        <p class="h5 mt-5 mb-3">Add a comment</p>

        @auth
        <p class="fs-12">
            Comment as <strong>{{ auth()->user()->name }}</strong>. 
            <a href="{{ route('logout') }}">Logout?</a>
        </p>
        @endauth

        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf

            @guest
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name" class="custom-label">Name</label>

                        <input type="text" name="name" id="name" class="form-control custom-form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Your name" value="{{ old('name') }}" required>

                        @if ($errors->has('name'))
                        <span class="invalid-message">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="email" class="custom-label">Email address</label>

                        <input type="email" name="email" id="email" class="form-control custom-form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Your email address" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                        <span class="invalid-message">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>
            </div>
            @endguest

            {{-- Comment body --}}
            <div class="form-group">

                <textarea name="body" id="body" class="form-control custom-form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" cols="30" rows="5" placeholder="Your comment..." required>{{ old('body') }}</textarea>

                @if ($errors->has('body'))
                <span class="invalid-message">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
                @endif

            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary" type="submit">Add comment</button>
            </div>

        </form>
    </div>
</div>

@include('layouts.sidebar')

</div>

@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
@endpush
@endsection
