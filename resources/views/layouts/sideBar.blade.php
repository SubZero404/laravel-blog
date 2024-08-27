<div class="side-bar">
    <nav class="navbar navbar-dark mb-3 bg-black sticky-top">
        <a class="navbar-brand w-100 text-danger my-2 fs-4 fw-bold" href="{{ url('/') }}">
            <i class="bi bi-strava fs-2"></i> STRAVA
        </a>
    </nav>

    <ul class="nav nav-fill flex-column m-2">
        <li class="text-white-50 fw-bold mb-2">
            <small>ADMIN DASHBOARD</small>
        </li>

        <li class="nav-item fs-6 px-2 py-3">
            <a href="{{ route('home') }}" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-grid-1x2-fill"></i> Analysis
            </a>
        </li>
        <li class="nav-item fs-6 px-2 py-3">
            <a href="#" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-window-stack"></i> To Blog
            </a>
        </li>
        <li class="nav-item fs-6 px-2 py-3">
            <a href="#" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-bell-fill"></i> Notification
            </a>
        </li>
        <li class="nav-item fs-6 px-2 py-3">
            <a href="#" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-gear-fill"></i> Settings
            </a>
        </li>


        <li class="text-white-50 fw-bold mb-2 mt-4">
            <small>POST MANAGEMENT</small>
        </li>

        <li class="nav-item fs-6 px-2 py-3">
            <a href="{{ route('post.index') }}" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-chat-quote-fill"></i> Post Lists
            </a>
        </li>
        <li class="nav-item fs-6 px-2 py-3">
            <a href="{{ route('post.create') }}" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-plus-circle-fill"></i> Create
            </a>
        </li>
        @manageLvl
            <li class="nav-item fs-6 px-2 py-3">
                <a href="{{ route('category.index') }}" class="nav-link p-0 text-decoration-none text-white text-start">
                    <i class="me-2 bi bi-collection-fill"></i> Category
                </a>
            </li>
        @endmanageLvl
        <li class="nav-item fs-6 px-2 py-3">
            <a href="{{ route('photo.index') }}" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-images"></i> Gallery
            </a>
        </li>


        <li class="text-white-50 fw-bold mb-2 mt-4">
            <small>USER MANAGEMENT</small>
        </li>

        <li class="nav-item fs-6 px-2 py-3">
            <a href="{{ route('user.index') }}" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-people-fill"></i> User Lists
            </a>
        </li>

        <li class="nav-item fs-6 px-2 py-3">
            <a href="#" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-chat-fill"></i> Chatting
            </a>
        </li>

        <li class="text-white-50 fw-bold mb-2 mt-4">
            <small>ACCOUNT MANAGEMENT</small>
        </li>

        <li class="nav-item fs-6 px-2 py-3">
            <a href="#" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-person-circle"></i> Profile
            </a>
        </li>
        <li class="nav-item fs-6 px-2 py-3">
            <a href="#" class="nav-link p-0 text-decoration-none text-white text-start">
                <i class="me-2 bi bi-person-fill-lock"></i> SignOut
            </a>
        </li>
    </ul>
</div>
