@extends('page.master')

@section('content')
    @include('page.postFilter')
    <div class="d-flex flex-column align-items-center mt-2">
        @foreach($posts as $post)
            <div class="post-card d-flex flex-row col-12 col-md-10 col-lg-9 col-xl-8 mb-4">
                <div class="img-div overflow-hidden rounded">
                    @if($post->featured_image == null)
                        <img src="{{ asset('storage/ks_logo.jpg') }}" alt="">
                    @else
                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="">
                    @endif

                </div>
                <div class="content-div p-2 d-flex flex-column justify-content-between">
                    <div class="title p-2">
                        <h3 class="fs-5 text-light">{{ $post->title }}</h3>
                        <div class="d-flex flex-row justify-content-between w-100">
                            <a href="{{ route('page.by-category',$post->category->slug) }}" class="badge text-bg-danger text-decoration-none">{{ $post->category->title }}</a>
                            <span><i class="bi bi-clock me-1"></i>{{ $post->created_at->diffForHumans() }}</span>
                            <span><i class="bi bi-person me-1"></i>{{ $post->user->name }}</span>
                        </div>
                    </div>
                    <div class="description px-4">
                        <p class="fst-italic m-0">{{ $post->excerpt }}</p>
                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <a href="{{ route('page.show',$post->slug) }}" class="btn btn-outline-danger btn-sm me-3">READ</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-12 col-md-10 col-lg-9 col-xl-8">
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
@endsection
