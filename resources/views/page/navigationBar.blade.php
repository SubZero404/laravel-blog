<nav class="navbar navbar-expand-lg">
    <div class="w-100 d-flex justify-content-between pt-2">
        <div class="navbar-nav">
            <a href="#" class="nav-item text-light me-2">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="nav-item text-light me-2">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="#" class="nav-item text-light me-2">
                <i class="bi bi-tiktok"></i>
            </a>
        </div>
        <a class="navbar-brand text-light my-2 fs-1 fw-bold" href="{{ url('/') }}">
            <i class="bi bi-strava fs-2"></i> Blog
        </a>
        <div class="navbar-nav">
            @auth
                <div class="d-flex flex-column justify-content-start align-items-center pt-2">
                    <p class="me-2 fw-bold" style="cursor: pointer" onclick="toggleLogout()">Kyal Sin Tun <i class="bi bi-caret-down-fill"></i></p>
                    <a class="nav-item d-none logout-link text-light me-2 text-decoration-none animate__animated animate__fadeOutUp"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @else
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @endauth
        </div>
    </div>
</nav>

@push('script')
    <script>
        function toggleLogout() {
            let logout_link = document.querySelector('.logout-link');

            if (logout_link.classList.contains('d-none')) {
                // If currently hidden, remove 'd-none' and add 'animate__fadeInDown'
                logout_link.classList.remove('d-none');
                logout_link.classList.remove('animate__fadeOutUp');
                logout_link.classList.add('animate__fadeInDown');
            } else {
                // If currently visible, add 'animate__fadeOutUp'
                logout_link.classList.remove('animate__fadeInDown');
                logout_link.classList.add('animate__fadeOutUp');

                // Wait for the animation to complete before hiding the element
                logout_link.addEventListener('animationend', function() {
                    logout_link.classList.add('d-none');
                }, { once: true });
            }
        }
    </script>
@endpush
