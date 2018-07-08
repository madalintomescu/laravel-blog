<nav class="navbar navbar-light navbar-expand-lg py-3">
    <div class="container">

        <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">{{ config('app.name') }}</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavigation">
            <ul class="navbar-nav ml-auto">

                @guest
                <li class="nav-item nav-item-custom">
                    <a href="/login" class="nav-link nav-link-custom">Login</a>
                </li>
                <li class="nav-item nav-item-custom">
                    <a href="/register" class="nav-link nav-link-custom">Register</a>
                </li>
                @endguest

                @auth
                <li class="nav-item nav-item-custom dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" class="img-avatar" alt="{{ auth()->user()->name }}">
                    </a>

                    <div class="dropdown-menu profile-dropdown p-0" aria-labelledby="navbarDropdown">
                        <a href="/dashboard" class="dropdown-item">Dashboard</a>

                        <a href="{{ route('users.show', auth()->user()->id) }}" class="dropdown-item">Profile</a>

                        @can('manage posts')
                        <a href="{{ route('dashboard.posts.create') }}" class="dropdown-item">New post</a>
                        @endcan

                        <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                    </div>

                </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
