@extends('layouts.base')

@if (Route::is('categories.show'))
    @section("pageTitle", "Posts in $category->name category")
@elseif (Route::is('tags.show'))
    @section("pageTitle", "Posts with $tag->name tag")
@else
    @section("pageTitle", "Home")
@endif

@section('content')

<div class="row mt-md-5">
    <div class="col-12 col-lg-8">

        @if (Route::is('categories.show'))
        <h1 class="mb-4 fs-24 c-777">
            Posts in {{ $category->name }} category
        </h3>
        @elseif (Route::is('tags.show'))
        <h1 class="mb-4 fs-24 c-777">
            Posts with {{ $tag->name }} tag
        </h1>
        @endif

        @forelse ($posts as $post)

        <article class="mb-5">

            @if ($post->image)
            <a href="{{ route('posts.show', $post->slug) }}">
                <img src="{{ asset('storage/post/' . $post->image) }}" class="img-fluid">
            </a>
            @endif

            <h2>
                <a class="post-title" href="{{ route('posts.show', $post->slug) }}">
                    {{ $post->title}}
                </a>
            </h2>

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

            </div>

            <p class="post-body mt-2">
                {{ str_limit(strip_tags($post->body), 400) }}
            </p>

        </article>

        @empty
        <p class="text-center">No posts</p>
        @endforelse

        {{ $posts->links() }}

    </div>

    @include('layouts.sidebar')

</div>

@endsection
