<nav id="navbar" class="navbar navbar-expand-lg py-3 fixed-top bg-white shadow-sm transition">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">MyApp</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
                </li>

                <li class="nav-item ms-3">
                    <button id="themeToggle" class="btn btn-outline-secondary rounded-circle p-2">
                        🌙
                    </button>
                </li>

                <li class="nav-item ms-3">
                    <a class="btn btn-primary rounded-pill px-4" href="{{ url('/login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
