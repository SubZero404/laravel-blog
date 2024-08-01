@extends('layouts.app')

@section('content')
    <div class="m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house"></i>
                    <a href="{{ route('home') }}"> Home</a>
                </li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
        </nav>
    </div>

    {{--    card start--}}
    <div class="container-fluid p-0 overflow-scroll scrollbar window-session bg-black rounded">
        <div class="card bg-black border-0 w-100">
            {{--            card header--}}
            <div class="card-header d-flex justify-content-between mx-2">
                <div class="d-flex align-items-center">
                    <i class="bi bi-chat-quote-fill fs-4"></i>
                    <span class="fw-bolder ms-2">Posts</span>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-dark custom-btn me-2" onclick="toggle_window(this)">
                        <i class="bi bi-arrows-angle-expand"></i>
                        <i class="bi bi-arrows-angle-contract d-none"></i>
                    </button>
                    <a href="{{ route('post.create') }}" class="btn btn-dark custom-btn">
                        <i class="bi bi-plus"></i>
                    </a>
                </div>
            </div>
            {{--            card body--}}
            <div class="card-body">

            </div>
        </div>
    </div>

    {{--    card end--}}

    @push('script')
        <script>
            function toggle_window(e) {
                e.children[0].classList.toggle('d-none')
                e.children[1].classList.toggle('d-none')
                document.querySelector('.window-session').classList.toggle('window-expand')
            }
        </script>
    @endpush
@endsection
