@extends('layouts.dashboard.base')
@section('pageTitle', 'Dashboard')

@section('content')

{{ Breadcrumbs::render('dashboard') }}

<div class="container-fluid">

    @if (!auth()->user()->hasRole('user'))
    <div class="row">

        <div class="col">
            <div class="callout callout-blue my-3 p-3 bg-white rounded box-shadow">
                <small class="text-muted">Users</small><br>
                <strong class="h4">{{ $users_count }}</strong>
            </div>
        </div>

        <div class="col">
            <div class="callout callout-red my-3 p-3 bg-white rounded box-shadow">
                <small class="text-muted">Posts</small><br>
                <strong class="h4">{{ $posts_count }}</strong>
            </div>
        </div>

        <div class="col">
            <div class="callout callout-purple my-3 p-3 bg-white rounded box-shadow">
                <small class="text-muted">Comments</small><br>
                <strong class="h4">{{ $comments_count }}</strong>
            </div>
        </div>
    </div>
    @endif

    <div class="row mt-5">

        <div class="col-lg-6">

            <h6 class="fw-400 c-777">Latest posts</h6>

            @if ($posts_count)
            <div class="my-3 px-2 py-1 bg-white rounded box-shadow">
                <table class="table table-borderless fs-14 mb-0">

                    <thead>
                        <tr class="thead-row">
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Created</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($posts as $post)
                        <tr>

                            <td>
                                <a href="{{ route('posts.show', $post->id) }}">
                                    {{ $post->title }}
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('users.show', $post->user->id) }}">
                                    {{ $post->user->name }}
                                </a>
                            </td>

                            <td>
                                {{ $post->created_at->diffForHumans() }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
            <p>No posts found</p>
            @endif
        </div>

        <div class="col-lg-6">

            <h6 class="fw-400 c-777">Latest comments</h6>

            @if ($comments_count)
            <div class="my-3 px-2 py-1 bg-white rounded box-shadow">
                <table class="table table-borderless fs-14 mb-0">

                    <thead>
                        <tr class="thead-row">
                            <th scope="col">Author</th>
                            <th scope="col">Comment</th>
                            <th scope="col">On post</th>
                            <th scope="col">Created</th>
                        </thead>

                        <tbody>
                            @foreach ($comments as $comment)
                            <tr>

                                <td>
                                    @if ($comment->user)
                                    <a href="{{ route('users.show', $comment->user->id) }}">
                                        {{ $comment->user->name }}
                                    </a>
                                    @else
                                    {{ $comment->name }}
                                    @endif
                                </td>

                                <td>
                                    {{ str_limit($comment->body, 50) }}
                                </td>

                                <td>
                                    <a href="{{ route('posts.show', $comment->post->id) }}#comment-{{ $comment->id }}">
                                        {{ $comment->post->title }}
                                    </a>
                                </td>

                                <td>
                                    {{ $comment->created_at->diffForHumans() }}
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p>No comments found</p>
                @endif

            </div>
        </div>
    </div>

    @endsection
