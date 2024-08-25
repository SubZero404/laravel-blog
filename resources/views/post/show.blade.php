@extends('layouts.app')

@section('content')

    @push('style')
        <style>
            .feature-image-label i:before{
                transform: scale(1.75);
            }
        </style>
    @endpush

    <div class="m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house"></i>
                    <a href="{{ route('home') }}"> Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('post.index') }}"> Posts</a>
                </li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid p-0 overflow-scroll scrollbar window-session bg-black rounded">
        <div class="card bg-black border-0 w-100">
            {{--            card header--}}
            <div class="card-header d-flex justify-content-between mx-2">
                <div class="d-flex align-items-center">
                    <i class="bi bi-layout-text-window-reverse fs-4"></i>
                    <span class="fw-bolder ms-2">View Post</span>
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
                    <a href="{{ route('post.index') }}" class="btn btn-dark custom-btn me-2" >
                        <i class="bi bi-list-ul"></i>
                    </a>
                    <a href="{{ route('post.edit',$post) }}" class="btn btn-dark custom-btn">
                        <i class="bi bi-pencil-fill text-warning"></i>
                    </a>
                </div>
            </div>
            {{--            card body--}}
            <div class="card-body">
                <div class="row flex-lg-row">
                    <div class="col-lg-9 col-12">
                        <div class="p-2 mb-3">
                            <h2 class="ms-3 fs-6 mb-3">TITLE</h2>
                            <div class="bg-dark p-3 rounded">
                                <p>{{ $post->title }}</p>
                                <small class="text-secondary">slug : {{ $post->slug }}</small>
                            </div>
                        </div>
                        @if(!$post->photos->isEmpty())
                            <div class="p-2 mb-3 post-photo-show-div d-flex flex-column align-items-center">
                                <h2 class="ms-3 fs-6 mb-3 col-12">POST PHOTOS</h2>
                                <div id="carouselExampleIndicators" class="carousel slide col-12 col-md-10 col-lg-8">
                                    <div class="carousel-indicators position-absolute" style="top: 90% !important; height: 20px;">
                                        @for($count = 0; $count < $post->photos->count(); $count++)
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $count }}" aria-label="Slide {{ $count }}"></button>
                                        @endfor
                                    </div>
                                    <div class="carousel-inner">
                                        @foreach($post->photos as $photo)
                                            <div class="carousel-item position-relative">
                                                <img src="{{ asset('storage/'.$photo->name) }}" alt="{{ $photo->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    @push('script')
                                        <script>
                                            let carousel_inner = document.querySelector('.carousel-inner');
                                            let carousel_indicators = document.querySelector('.carousel-indicators');

                                            // add class->active to the first image
                                            carousel_inner.firstElementChild.classList.add('active');

                                            // add class="active" aria-current="true" to the first carousel indicator
                                            first_carousel_indicator_btn = carousel_indicators.firstElementChild;
                                            first_carousel_indicator_btn.classList.add('active');
                                            first_carousel_indicator_btn.setAttribute('aria-current','true')
                                        </script>
                                    @endpush
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="bi bi-chevron-left" aria-hidden="true" style="transform: scale(3)"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="bi bi-chevron-right" aria-hidden="true" style="transform: scale(3)"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="p-2 mb-3">
                            <h2 class="ms-3 fs-6 mb-3">EXCERPT</h2>
                            <div class="bg-dark p-3 rounded">{!! html_entity_decode($post->excerpt) !!} </div>
                        </div>
                        <div class="p-2 mb-3">
                            <h2 class="ms-3 fs-6 mb-3">DESCRIPTION</h2>
                            <div class="bg-dark p-3 rounded">{!! html_entity_decode($post->description) !!}</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 d-flex flex-wrap d-lg-block">
                        <div class="p-2 mb-3">
                            <h2 class="ms-3 fs-6">
                                Owner :
                                <span class="text-danger">{{ $post->user->name }}</span>
                            </h2>
                        </div>
                        <div class="p-2 mb-3">
                            <h2 class="ms-3 fs-6">
                                Category :
                                <span class="text-danger">{{ $post->category->title ?? 'uncategorized' }}</span>
                            </h2>
                        </div>
                        <div class="p-2 mb-3 d-flex flex-row">
                            <h2 class="ms-3 fs-6">Date</h2>
                            <p class="text-danger ms-3">
                                <span class="text-nowrap">
                                    <i class="bi bi-calendar me-1"></i> {{ $post->created_at->format('d M Y') }}
                                </span>
                                <br>
                                <span class="text-nowrap">
                                    <i class="bi bi-clock me-1"></i> {{ $post->created_at->format('h : m A') }}
                                </span>
                            </p>
                        </div>
                        <div class="p-2 mb-3">
                            <h2 class="ms-3 fs-6">Featured Image</h2>
                            <div id="feature-image-div" class="ms-3 d-flex justify-content-center align-items-center bg-dark overflow-hidden rounded">
                                @isset($post->featured_image)
                                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->featured_image }}">
                                @else
                                    <i class="bi bi-image" style="transform: scale(4)"></i>
                                @endisset
                            </div>
                        </div>
                        <div class="p-2 mb-3 ms-3">
                            <a href="{{ route('post.index') }}" class="btn btn-outline-danger">
                                <i class="bi bi-back"></i>
                                BACK TO POSTS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    card end--}}
@endsection
