<ul class="mt-3 nav nav-tabs">

    <li class="nav-item">
        <a href="{{ route('users.show', $user->id) }}" class="nav-link {{ active('users.show') }}">Profile</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('users.posts', $user->id) }}" class="nav-link {{ active('users.posts') }}">Posts</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('users.comments', $user->id) }}" class="nav-link {{ active('users.comments') }}">Comments</a>
    </li>

    @auth
    @if (auth()->user()->id === $user->id || auth()->user()->hasRole('admin'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.users.edit', $user->id) }}">Edit</a>
    </li>
    @endif
    @endauth

</ul>
