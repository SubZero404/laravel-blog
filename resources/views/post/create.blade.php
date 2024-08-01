@extends('layouts.app')

@section('content')

    @push('style')
        <style>
            .note-toolbar {
                background: #1E1E1EFF;
            }

            .note-editable {
                min-height: 200px;
                background: #1E1E1EFF;
                color: white;
            }

            .window-expand .note-editable {
                min-height: 400px;
            }

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
                            <div class="p-2 mb-3">
                                <label for="title" class="form-label ms-3 mb-3">TITLE</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                       class="form-control @error('title') is-invalid @enderror" >
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
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
                            <div class="p-2 mb-3">
                                <h3 class="fs-6 ms-3 mb-3">FEATURE IMAGE</h3>
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

                                <input type="file" id="feature-image-input" value="{{ old('feature-image') }}" class="d-none" name="feature-image" accept="image/jpeg,image/png">
                                <label for="feature-image-input" class="feature-image-label btn btn-outline-light @error('feature-image') is-invalid bg-danger @enderror">
                                    <div id="feature-image-div" class="mb-3 bg-dark rounded overflow-hidden d-flex justify-content-center align-items-center">
                                        <i class="bi bi-image text-secondary" style="transform: scale(4)"></i>
                                    </div>
                                    <i class="bi bi-laptop me-2"></i>
                                    <span class="fw-bold">Upload Image</span>
                                </label>
                                @error('feature-image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="p-2 mb-3">
                                <button type="submit" class="btn btn-danger">POST</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--    card end--}}
@endsection
