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
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid p-0 overflow-scroll scrollbar window-session bg-black rounded">
        <div class="card bg-black border-0 w-100">
            {{--            card header--}}
            <div class="card-header d-flex justify-content-between mx-2">
                <div class="d-flex align-items-center">
                    <i class="bi bi-pencil-fill fs-4"></i>
                    <span class="fw-bolder ms-2">Edit Post</span>
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
                    <form action="{{ route('post.destroy',$post->id) }}" method="post" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark custom-btn">
                            <i class="text-danger bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            {{--            card body--}}
            <div class="card-body">
                <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row flex-lg-row">
                        <div class="col-lg-9 col-12">
{{--                            title input--}}
                            <div class="p-2 mb-3">
                                <label for="title" class="form-label ms-3 mb-3">TITLE</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                                       class="form-control @error('title') is-invalid @enderror" >
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

{{--                            post excerpt input--}}
                            <div class="p-2 mb-3">
                                <label for="excerpt" class="form-label ms-3 mb-3">EXCERPT</label>
                                <textarea id="excerpt" name="excerpt" placeholder="Add the main topic of your post for user experience. Add minimum 10 words"
                                          class="w-100 p-2 bg-dark rounded border-0 @error('excerpt') is-invalid @enderror"
                                >{{ old('excerpt',$post->excerpt) }}</textarea>
                                @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

{{--                            post description input--}}
                            <div class="p-2 mb-3">
                                <label for="description" class="form-label ms-3 mb-3">DESCRIPTION</label>
                                <div class="bg-black rounded">
                                    <textarea id="description" name="description"
                                              class="note-icon-summernote @error('description') is-invalid @enderror"
                                    >{{ old('description', $post->description) }}</textarea>
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
                        <div class="col-lg-3 col-12">
{{--                            post category input--}}
                            <div class="p-2 mb-3">
                                <label for="category" class="form-label ms-3 mb-3">CATEGORY</label>
                                <select name="category" id="category"
                                        class="form-select @error('category') is-invalid @enderror">
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" @if($category->id == old('category', $post->category_id)) selected @endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

{{--                            post photos input--}}
                            <div class="p-2 mb-3">
                                <p class="form-label ms-3 mb-3">PHOTO <span class="badge text-bg-danger photos-count-badge">{{ $post->photos->count() }}</span></p>
                                <div class="d-flex flex-row justify-content-start mt-1">
{{--                                    to upload new photo--}}
                                    <input type="file" id="photos-input" class="d-none" name="photos[]" accept="image/jpeg,image/png" multiple>
                                    <label for="photos-input" class="photo-label input-icon-label me-2 btn btn-outline-light btn-sm @error('photos.*') is-invalid bg-danger @enderror">
                                        <i class="bi bi-images me-2"></i>
                                        <span class="fw-bold">Upload Photos</span>
                                    </label>
                                    {{--                                to view photos that selected--}}
                                    <button type="button" onclick="togglePhotoDisplayDiv()" class="btn btn-outline-success btn-sm me-1">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    @error('photos.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{--                            post photos display--}}
                            <div class="photo-display-div d-none justify-content-around align-items-center">
                                <div class="col-lg-6 col-12 bg-secondary rounded overflow-hidden scrollbar">
                                    <div class="w-100 border-bottom d-flex justify-content-between align-items-center bg-dark">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="bi bi-images text-danger ms-4 fs-4"></i>
                                            <h6 class="ms-1 mb-0">VIEW <span class="text-danger">PHOTOS</span></h6>
                                        </div>
                                        <div class="d-flex flex-row mt-1">
{{--                                            to delete old photo that you don't wnat to keep--}}
                                            <button type="button" onclick="toggleDeleteOldPhotoDiv()" class="to-delete-old-photo-btn btn btn-light custom-btn btn-sm m-2">
                                                <i class="bi bi-trash"></i> delete old
                                            </button>
                                            <button type="button" onclick="toggleDeleteOldPhotoDiv()" class="to-display-photo-btn btn btn-light custom-btn btn-sm m-2 d-none">
                                                <i class="bi bi-stars"></i> done
                                            </button>
                                            <button type="button" class="btn btn-light custom-btn btn-sm m-2" onclick="togglePhotoDisplayDiv()">
                                                <i class="bi bi-x" style="transform: scale(2)"></i>
                                            </button>
                                        </div>

                                    </div>
{{--                                    view photos carousel div--}}
                                    <div id="carouselExampleIndicators" class="carousel slide">
                                        <div class="carousel-indicators position-absolute" style="top: 90% !important; height: 20px;">
                                            @for($count = 0; $count < $post->photos->count(); $count++)
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $count }}" aria-label="Slide {{ $count }}"></button>
                                            @endfor
                                        </div>
                                        <div class="carousel-inner">
                                            @foreach($post->photos as $photo)
                                                <div class="carousel-item position-relative" id="photo-id-{{ $photo->id }}">
                                                    <div class="d-none">
                                                        <span class="badge text-bg-danger fs-6">
                                                            <i class="bi bi-trash"></i>
                                                            <i class="bi bi-check"></i>
                                                        </span>
                                                    </div>
                                                    <img src="{{ asset('storage/'.$photo->name) }}" alt="{{ $photo->name }}">
                                                </div>
                                            @endforeach
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
{{--                                    delete old photos div--}}
                                    <div class="delete-old-photo-div d-none bg-dark overflow-scroll scrollbar">
                                        <h3 class="fs-6 text-center py-2">Delete Old Photos</h3>
                                        <p class="ms-5">select photo that you want to delete and click <span class="text-danger">done</span> button</p>
                                        <div class="d-flex flex-wrap mx-3 justify-content-around">
                                            @foreach($post->photos as $photo)
                                                <div class="delete-photo-div bg-black shadow-lg mb-5 mx-2 rounded overflow-hidden">
                                                    <img src="{{ asset('storage/'.$photo->name) }}" alt="{{ $photo->name }}">
                                                    <div class="form-check pt-1">
                                                        <label for="photo-id-{{ $photo->id }}"></label>
                                                        <input class="form-check-input" id="photo-id-{{ $photo->id }}" type="checkbox" name="delete_old_photos[]" value="{{ $photo->id }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--                                        script for display photos of post -----------------------}}
                            @push('script')
                                <script>
                                    let carousel_indicators = document.querySelector('.carousel-indicators');
                                    let carousel_inner = document.querySelector('.carousel-inner');
                                    let photo_display_div = document.querySelector('.photo-display-div');
                                    let photo_input = document.getElementById('photos-input');
                                    let photo_label = document.querySelector('.photo-label')
                                    let photos_count_badge = document.querySelector('.photos-count-badge');
                                    let delete_old_photo_div = document.querySelector('.delete-old-photo-div');
                                    let carousel_div = document.querySelector('.carousel');
                                    let to_delete_old_photo_btn = document.querySelector('.to-delete-old-photo-btn');
                                    let to_display_photo_btn = document.querySelector('.to-display-photo-btn');
                                    let checkboxs = document.querySelectorAll('input[type="checkbox"]')

                                    if (carousel_inner.children.length > 0) {
                                        // add class->active to the first image
                                        carousel_inner.firstElementChild.classList.add('active');

                                        // add class="active" aria-current="true" to the first carousel indicator
                                        first_carousel_indicator_btn = carousel_indicators.firstElementChild;
                                        first_carousel_indicator_btn.classList.add('active');
                                        first_carousel_indicator_btn.setAttribute('aria-current','true')
                                    }

                                    function togglePhotoDisplayDiv() {
                                        photo_display_div.classList.toggle('d-none');
                                        photo_display_div.classList.toggle('d-flex');

                                    }

                                    //load image from and display in photo display div
                                    photo_input.addEventListener('change', function (){
                                        let photos_count_badge = document.querySelector('.photos-count-badge');
                                        let count = parseInt(photos_count_badge.textContent);

                                        let new_carousel_indicator = document.querySelectorAll('.new-carousel-indicator');
                                        new_carousel_indicator.forEach(element => {
                                            element.remove();
                                            count = count - 1;
                                        })
                                        let new_carousel_item = document.querySelectorAll('.new-carousel-item');
                                        new_carousel_item.forEach(element => {
                                            element.remove();
                                        })

                                        let photos = this.files;

                                        photos_count_badge.textContent = parseInt(photos.length) + count;
                                        for (const photo of photos) {
                                            const reader = new FileReader();
                                            reader.addEventListener('load',() => {
                                                addCarouselItem(reader.result,count);
                                                count = addCarouselIndicator(count);
                                            })
                                            reader.readAsDataURL(photo);
                                        }
                                        togglePhotoDisplayDiv();
                                    })

                                    photo_label.addEventListener('click', CarouselIndicatorActive)

                                    function CarouselIndicatorActive() {
                                        let count = parseInt(document.querySelector('.photos-count-badge').textContent);
                                        let new_carousel_indicator = document.querySelectorAll('.new-carousel-indicator');
                                        let carousel_control_next_btn = document.querySelector('.carousel-control-next');
                                        let foundActive = false;

                                        new_carousel_indicator.forEach(element => {
                                            let aria_label = element.getAttribute('aria-label');
                                            let indicator_number = parseInt(aria_label.split(' ')[1]);
                                            if(indicator_number === 0) {
                                                foundActive = true;
                                            }
                                            if (element.classList.contains('active') && !foundActive) {
                                                let different = count - indicator_number;

                                                if (different > 0) {
                                                    for (let i = 0; i < different; i++) {
                                                        setTimeout(function() {
                                                            carousel_control_next_btn.click();
                                                        }, i * 1000); // Delay each click by 500ms
                                                    }
                                                }

                                                foundActive = true;
                                            }
                                        });
                                    }

                                    function addCarouselIndicator(count) {

                                        let button = document.createElement('button');
                                        button.setAttribute('type','button');
                                        button.setAttribute('data-bs-target','#carouselExampleIndicators');
                                        button.setAttribute('data-bs-slide-to',count);
                                        button.setAttribute('aria-label','Slide '+count);
                                        button.classList.add('new-carousel-indicator')
                                        if(count === 0) {
                                            button.classList.add('active');
                                            button.setAttribute('aria-current','true')
                                        }
                                        carousel_indicators.appendChild(button);

                                        return count + 1;
                                    }

                                    function addCarouselItem(reader_result,count) {
                                        let div = document.createElement('div');
                                        div.classList.add('carousel-item');
                                        div.classList.add('new-carousel-item');
                                        if(count === 0) {
                                            div.classList.add('active');
                                        }

                                        let img = document.createElement('img');
                                        img.src = reader_result;

                                        let inner_div = document.createElement('div');
                                        let span = document.createElement('span');
                                        span.setAttribute('class','badge text-bg-danger fs-6 fw-light pt-0 my-2')
                                        span.innerText = 'new';

                                        inner_div.appendChild(span);
                                        div.appendChild(inner_div);
                                        div.appendChild(img)
                                        carousel_inner.appendChild(div)
                                    }

                                    // toggle delete old photo div
                                    function toggleDeleteOldPhotoDiv() {
                                        delete_old_photo_div.classList.toggle('d-none');
                                        carousel_div.classList.toggle('d-none');
                                        to_delete_old_photo_btn.classList.toggle('d-none');
                                        to_display_photo_btn.classList.toggle('d-none');
                                    }

                                    checkboxs.forEach(checkbox => {
                                        checkbox.addEventListener('change', function () {
                                            let photo_id = checkbox.value;
                                            let checked_photo = document.getElementById('photo-id-'+photo_id)
                                            if(checkbox.checked) {
                                                checked_photo.firstElementChild.classList.remove('d-none')
                                                console.log(photo_id+'is checked')
                                                photos_count_badge.textContent = parseInt(photos_count_badge.textContent) - 1;
                                            } else {
                                                checked_photo.firstElementChild.classList.add('d-none')
                                                console.log(photo_id+'is unchecked')
                                                photos_count_badge.textContent = parseInt(photos_count_badge.textContent) + 1;
                                            }
                                        })
                                    })

                                </script>
                            @endpush

{{--                            post feature image input--}}
                            <div class="p-2 mb-3">
                                <h3 class="fs-6 ms-3 mb-3">FEATURE IMAGE</h3>
                                @push('script')
                                    <script type="module">
                                        // display feature image that selected
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

                                <input type="file" id="feature-image-input" class="d-none" name="featured-image" accept="image/jpeg,image/png">
                                <label for="feature-image-input" class="input-icon-label btn btn-outline-secondary @error('feature-image') is-invalid bg-danger @enderror">
                                    <div id="feature-image-div" class="mb-3 bg-dark rounded overflow-hidden d-flex justify-content-center align-items-center">
                                        @isset($post->featured_image)
                                            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->featured_image }}">
                                        @else
                                            <i class="bi bi-image text-secondary" style="transform: scale(4)"></i>
                                        @endisset
                                    </div>
                                    <i class="bi bi-laptop me-2"></i>
                                    <span class="fw-bold">Upload Image</span>
                                </label>
                                @error('feature-image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

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
