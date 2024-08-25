@extends('layouts.app')

@section('content')

    @push('style')
        <style>

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
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid p-0 overflow-scroll scrollbar window-session bg-black rounded">
        <div class="card bg-black border-0 w-100">
            {{--            card header--}}
            <div class="card-header d-flex justify-content-between mx-2">
                <div class="d-flex align-items-center">
                    <i class="bi bi-plus-circle-fill fs-4"></i>
                    <span class="fw-bolder ms-2">Create Post</span>
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
                    <a href="{{ route('post.index') }}" class="btn btn-dark custom-btn" >
                        <i class="bi bi-list-ul"></i>
                    </a>
                </div>
            </div>
            {{--            card body--}}
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row flex-lg-row">
                        <div class="col-lg-9 col-12">
{{--                            Title--}}
                            <div class="p-2 mb-3">
                                <label for="title" class="form-label ms-3 mb-3">TITLE</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                       class="form-control @error('title') is-invalid @enderror" >
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

{{--                            excerpt--}}
                            <div class="p-2 mb-3">
                                <label for="excerpt" class="form-label ms-3 mb-3">EXCERPT</label>
                                <textarea id="excerpt" name="excerpt" placeholder="Add the main topic of your post that same as description. Add minimum 10 words"
                                          class="w-100 p-2 bg-dark rounded border-0 @error('excerpt') is-invalid @enderror"
                                >{{ old('excerpt') }}</textarea>
                                @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

{{--                            description--}}
                            <div class="p-2 mb-3">
                                <label for="description" class="form-label ms-3 mb-3">DESCRIPTION</label>
                                <div class="bg-black rounded">
                                    <textarea id="description" name="description"
                                              class="note-icon-summernote @error('description') is-invalid @enderror"
                                              >{{ old('description') }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                @push('script')
                                    <script type="module">
                                        $('#description').summernote({
                                            placeholder: "what's in your mine?",
                                            tabsize: 2,
                                        });
                                    </script>
                                @endpush
                            </div>
                        </div>

{{--                            category--}}
                        <div class="col-lg-3 col-12">
                            <div class="p-2 mb-3">
                                <label for="category" class="form-label ms-3 mb-3">CATEGORY</label>
                                <select name="category" id="category"
                                        class="form-select @error('category') is-invalid @enderror">
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" @if($category->id == old('category')) selected @endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

{{--                            post photos upload--}}
                            <div class="p-2 mb-3">
                                <p class="form-label ms-3 mb-3">PHOTO <span class="badge text-bg-danger photos-count-badge">0</span></p>
                                <div class="d-flex flex-row justify-content-around align-items-center">
                                    <input type="file" id="photos-input" class="d-none" name="photos[]" accept="image/jpeg,image/png" multiple>
                                    <label for="photos-input" class="input-icon-label btn btn-outline-light btn-sm @error('photos.*') is-invalid bg-danger @enderror">
                                        <i class="bi bi-images me-2"></i>
                                        <span class="fw-bold">Upload Photos</span>
                                    </label>
                                    {{--                                to view photos that selected--}}
                                    <button type="button" onclick="togglePhotoDisplayDiv()" class="btn btn-outline-success btn-sm"><i class="bi bi-eye-fill"></i></button>
                                    @error('photos.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

{{--                            post photos display--}}
                            <div class="photo-display-div d-none justify-content-center align-items-center">
                                <div class="col-lg-6 col-12 bg-secondary rounded shadow-lg overflow-scroll scrollbar">
                                    <div class="w-100 border-bottom d-flex justify-content-between align-items-center bg-dark">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="bi bi-images text-danger ms-4 fs-4"></i>
                                            <h6 class="ms-1 mb-0">VIEW <span class="text-danger">PHOTOS</span></h6>
                                        </div>
                                        <div class="d-flex flex-row mt-1">
                                            <button type="button" class="btn btn-light custom-btn btn-sm m-2" onclick="togglePhotoDisplayDiv()">
                                                <i class="bi bi-x" style="transform: scale(2)"></i>
                                            </button>
                                        </div>

                                    </div>
                                    <div id="carouselExampleIndicators" class="carousel slide">
                                        <div class="carousel-indicators position-absolute" style="top: 90% !important; height: 20px;"></div>
                                        <div class="carousel-inner">

                                        </div>
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
                            </div>
{{--                            script for display photos of post -----------------------}}
                            @push('script')
                                <script>
                                    let carousel_indicators = document.querySelector('.carousel-indicators');
                                    let carousel_inner = document.querySelector('.carousel-inner');
                                    let photo_display_div = document.querySelector('.photo-display-div');
                                    let photo_input = document.getElementById('photos-input');
                                    let photos_count_badge = document.querySelector('.photos-count-badge');

                                    function togglePhotoDisplayDiv() {
                                        photo_display_div.classList.toggle('d-none');
                                        photo_display_div.classList.toggle('d-flex');
                                    }

                                    //load image from and display in photo display div
                                    photo_input.addEventListener('change', function (){
                                        carousel_inner.innerHTML = null;
                                        carousel_indicators.innerHTML = null;
                                        let photos = this.files;
                                        console.log(photos.length)
                                        photos_count_badge.innerHTML = photos.length;
                                        let count = 0;
                                        for (const photo of photos) {
                                            const reader = new FileReader();
                                            reader.addEventListener('load',() => {
                                                addCarouselItem(reader.result,count);
                                                count = addCarouselIndicators(count);
                                            })
                                            reader.readAsDataURL(photo);
                                        }
                                        togglePhotoDisplayDiv();
                                    })

                                    function addCarouselIndicators(count) {

                                        let button = document.createElement('button');
                                        button.setAttribute('type','button');
                                        button.setAttribute('data-bs-target','#carouselExampleIndicators');
                                        button.setAttribute('data-bs-slide-to',count);
                                        button.setAttribute('aria-label','Slide '+count);
                                        if(count === 0) {
                                            button.classList.add('active');
                                            button.setAttribute('aria-current','true')
                                        }
                                        carousel_indicators.appendChild(button);

                                        return count + 1;
                                    }

                                    function addCarouselItem(reader_result,count) {
                                        let div = document.createElement('div');
                                        div.classList.add('carousel-item')
                                        if(count === 0) {
                                            div.classList.add('active');
                                        }

                                        let img = document.createElement('img');
                                        img.src = reader_result;
                                        img.setAttribute('class','d-block w-100 w-100 h-100 object-fit-contain');
                                        img.style.objectPosition = 'center';

                                        div.appendChild(img)
                                        carousel_inner.appendChild(div)
                                    }

                                </script>
                            @endpush


{{--                                feature image input--}}
                            <div class="p-2 mb-3">
                                <h3 class="fs-6 ms-3 mb-3">FEATURE IMAGE</h3>
                                <input type="file" id="feature-image-input" value="{{ old('feature-image') }}" class="d-none" name="feature-image" accept="image/jpeg,image/png">
                                <label for="feature-image-input" class="input-icon-label btn btn-outline-light @error('feature-image') is-invalid bg-danger @enderror">
                                    <div id="feature-image-div" class="mb-3 bg-dark rounded overflow-hidden d-flex justify-content-center align-items-center">
                                        <i class="bi bi-image text-secondary" style="transform: scale(4)"></i>
                                    </div>
                                    <i class="bi bi-laptop me-2"></i>
                                    <span class="fw-bold">Upload Image</span>
                                </label>
                                @error('feature-image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
{{--                            script for feature image--}}
                            @push('script')
                                <script type="module">
                                    $(document).ready( function () {
                                        let feature_image_div = document.getElementById('feature-image-div')

                                        document.getElementById('feature-image-input').addEventListener('change', function() {
                                            const reader = new FileReader();

                                            reader.addEventListener('load', () => {
                                                feature_image_div.innerHTML = "";
                                                let img = document.createElement('img');
                                                img.src = reader.result;
                                                feature_image_div.appendChild(img);
                                            })

                                            reader.readAsDataURL(this.files[0])
                                        })
                                    })
                                </script>
                            @endpush

                            <div class="p-2 mb-3 d-flex flex-wrap">
{{--                                submit button--}}
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="bi bi-save-fill"></i>
                                    POST
                                </button>
{{--                                cancel button--}}
                                <a href="{{ route('post.index') }}" class="btn btn-outline-danger">
                                    <i class="bi bi-backspace-fill"></i>
                                    CANCEL
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--    card end--}}
@endsection
