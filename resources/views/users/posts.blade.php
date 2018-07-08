@extends('layouts.base')
@section('pageTitle', 'User posts')

@section('content')

@include('users.navigation')

<h1 class="h6 mt-3">Posts ({{ $user->posts_count }})</h1>

<div class="card border-0">
    <ul class="list-group list-group-flush">
        @forelse ($posts as $post)
        <li class="list-group-item px-0">
            <div class="d-flex justify-content-between">
                <a href="{{ route('posts.show', $post->id) }}" class="w-75">{{ $post->title }}</a>
                <small class="text-muted ml-auto">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </li>
        @empty
        No posts
        @endforelse
    </ul>
</div>

{{ $posts->links() }}

@endsection
