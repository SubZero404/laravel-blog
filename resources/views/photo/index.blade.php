@extends('layouts.app')

@section('content')
    <div class="m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house"></i>
                    <a href="{{ route('home') }}" class=""> Home</a>
                </li>
                <li class="breadcrumb-item active">Gallery</li>
            </ol>
        </nav>
    </div>

    {{--    card start--}}
    <div class="container-fluid p-0 overflow-scroll scrollbar window-session bg-black rounded">
        <div class="card bg-black border-0">
            {{--            card header--}}
            <div class="card-header d-flex justify-content-between mx-2">
                <div class="d-flex align-items-center">
                    <i class="bi bi-images fs-4"></i>
                    <span class="fw-bolder ms-2">Photo Gallery</span>
                </div>
                <div class="search-form @if(!request('keyword')) d-none  @endif">
                    <form action="{{ route('post.index') }}" method="get">
                        <div class="input-group">
                            <input type="text" value="{{ request('keyword') }}" name="keyword" id="keyword" class="form-control" placeholder="Search">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-dark custom-btn me-2" onclick="toggle_window(this)">
                        <i class="bi bi-arrows-angle-expand"></i>
                        <i class="bi bi-arrows-angle-contract d-none"></i>
                    </button>
                    @push('script')
                        <script>
                            function toggle_window(e) {
                                e.children[0].classList.toggle('d-none')
                                e.children[1].classList.toggle('d-none')
                                document.querySelector('.window-session').classList.toggle('window-expand')
                            }
                        </script>
                    @endpush
                </div>
            </div>
            {{--            card body--}}
            <div class="card-body">
                <div class="photo-gallery-div">
                    @foreach(Auth::user()->photos as $photo)
                        <img class="w-100 rounded mb-3" src="{{ asset('Storage/'.$photo->name) }}" alt="{{ $photo->name }}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{--    card end--}}
@endsection

