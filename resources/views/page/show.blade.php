@extends('page.master')

@section('content')
    <div class="d-flex flex-column align-items-center">
        <div class="col-12 col-md-10 col-lg-8 text-end">
            <a href="{{ route('page.index') }}" class="btn btn-outline-light btn-sm"><i class="bi bi-x-lg"></i></a>
        </div>
        <div class="col-12 col-md-10 col-lg-8 d-flex flex-column align-items-center mb-4">
            <h2 class="fs-5 fw-light mb-4">{{ $post->title }}</h2>
            <div class="w-100 d-flex justify-content-around text-secondary fw-bold">
                <small class="fst-italic">{{ $post->created_at->diffforHumans() }}</small>
                <small class="fst-italic">{{ $post->category->title }}</small>
                <small class="fst-italic">{{ $post->user->name }}</small>
            </div>
        </div>
        <div class="col-12 col-md-10">
            @if(!$post->photos->isEmpty())
                <div class="p-2 mb-3 post-photo-show-div d-flex justify-content-center">
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
        </div>
        <div class="col-12 col-md-10 col-lg-8">
            {!! html_entity_decode($post->description) !!}
        </div>
        <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-end mb-5">
            <a href="{{ route('page.index') }}" class="btn btn-outline-light">BACK</a>
        </div>
    </div>
@endsection
