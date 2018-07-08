<aside class="col-12 col-lg-4 sidebar mt-3 mt-lg-0 pl-lg-5 fs-14">

    <div class="display-block mb-4 mb-lg-5">
        <h5 class="sidebar-title mb-3">Categories</h5>

        <ul class="list-unstyled mb-0">

            @foreach ($categories as $category)
            <li class="mb-2">
                <a class="sidebar-link" href="{{ route('categories.show', $category->slug) }}">
                    {{ $category->name }} 
                </a>

                <span class="badge badge-light float-right">
                    {{ $category->posts_count }}
                </span>
            </li>
            @endforeach

        </ul>

    </div>

    <div class="display-block mb-5">
        <h5 class="sidebar-title mb-3">Recent comments</h5>

        <ul class="list-unstyled mb-0">

            @forelse ($comments as $comment)
            <li class="mb-2">

                @if ($comment->user)              
                <a class="sidebar-link font-weight-bold" href="{{ route('users.show', $comment->user->id) }}">{{ $comment->user->name }}</a>
                @else
                <span class="font-weight-bold">{{ $comment->name }}</span>
                @endif

                on <a class="sidebar-link font-weight-bold" href="{{ route('posts.show', $comment->post->slug) }}#comment-{{ $comment->id }}">
                    {{ $comment->post->title }}
                </a>
                <p><small>{{ $comment->created_at->diffForHumans() }}</small></p>
            </li>
            @empty
            <p>No comments</p>
            @endforelse
        </ul>
    </div>

    <div class="display-block mb-5">

        <h5 class="sidebar-title mb-3">Tags</h5>

        <ul class="list-unstyled mb-0">
            @foreach ($tags as $tag)
            <a href="{{ route('tags.show', $tag->slug) }}" class="tag">
                {{ $tag->name }} 
            </a>
            @endforeach
        </ul>
    </div>
</aside>
