<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container d-flex justify-content-between align-items-center bg-black px-4 py-2 m-1 rounded">

        <!-- Logo -->
        <a class="navbar-brand text-light d-flex align-items-center gap-2 fw-bold fs-5" href="{{ url('/') }}">
            <i class="bi bi-strava fs-4"></i>
            <span>Blog</span>
        </a>

        <!-- Right Side -->
        <div class="navbar-nav d-flex align-items-center">

            @auth
                <!-- Profile Dropdown -->
                <div class="dropdown">
                    <p class="text-light fw-semibold dropdown-toggle mb-0"
                       style="cursor:pointer;"
                       data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </p>

                    <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-sm fade-down">
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>

                    <!-- Hidden logout form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            @else
                @if (Route::has('login'))
                    <a class="nav-link text-light mx-2 hover-white" href="{{ route('login') }}">Login</a>
                @endif

                @if (Route::has('register'))
                    <a class="nav-link text-light mx-2 hover-white" href="{{ route('register') }}">Register</a>
                @endif
            @endauth

        </div>
    </div>
</nav>
