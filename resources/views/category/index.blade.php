@extends('layouts.app')

@section('content')

{{--    breadcrumb start--}}
    <div class="m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house"></i>
                    <a href="{{ route('home') }}"> Home</a>
                </li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav>
    </div>
{{--    breadcrumb end--}}

{{--    card start--}}
    <div class="container-fluid p-0 overflow-scroll scrollbar window-session bg-black rounded">
        <div class="card bg-black border-0 w-100">
{{--            card header--}}
            <div class="card-header d-flex justify-content-between mx-2">
                <div class="d-flex align-items-center">
                    <i class="bi bi-collection-fill fs-4"></i>
                    <span class="fw-bolder ms-2">Category</span>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-dark custom-btn me-2" onclick="toggle_window(this)">
                        <i class="bi bi-arrows-angle-expand"></i>
                        <i class="bi bi-arrows-angle-contract d-none"></i>
                    </button>
                    <button class="btn btn-dark custom-btn" onclick="toggle_new(this)">
                        <i class="bi bi-plus @if(!old('id') and old('title')) d-none @else d-inline-block @endif"></i>
                        <i class="bi bi-x-lg @if(!old('id') and old('title')) d-inline-block @else d-none @endif"></i>
                    </button>
                </div>
            </div>
{{--            card body--}}
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        {{--                            new category form --}}
                        <div class="col-12 @if(!old('id') and old('title')) d-inline-block @else d-none @endif" id="category-new-form">
                            <form action="{{ route('category.store') }}" method="post" class="w-100">
                                @csrf
                                <div class="d-flex flex-row align-items-top justify-content-center">
                                    <div class="form-floating col-8 col-md-7 col-lg-6">
                                        <input type="text" name="title"
                                               class="form-control @if(!old('id')) @error('title') is-invalid @enderror @endif"
                                               id="floatingInput-category-create" placeholder="Category Name" value="@if(!old('id')) {{ old('title') }} @endif">
                                        @if(!old('id'))
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                        <label for="floatingInput-category-create">New Category</label>
                                    </div>
                                    <div class="col-3 d-flex align-items-start pt-2 ps-2">
                                        <button class="btn btn-outline-secondary btn-lg"><span class="text-white">Create</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--                            category table--}}
                        <div class="col-12 mt-3">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CATEGORY NAME</th>
                                    <th class="d-none d-lg-table-cell">CREATOR</th>
                                    <th>CREATED DATE</th>
                                    <th>CONTROL</th>
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                @forelse($categories as $category)
                                    <tr class="@if(old('id') == $category->id) d-none @endif category-tr" id="category-tr-{{ $category->id }}">
                                        <th>{{ $category->id }}</th>
                                        <th>
                                            <p class="my-0">{{ $category->title }}</p>
                                            <span class="badge bg-dark">{{ $category->slug }}</span>
                                        </th>
                                        <th class="d-none d-lg-table-cell">
                                            <p class="fw-lighter">{{ $category->user->name }}</p>
                                        </th>
                                        <th>
                                            <p class="my-0"><i class="bi bi-calendar me-1"></i> {{ $category->created_at->format('d M Y') }}</p>
                                            <p class="my-0"><i class="bi bi-clock me-1"></i> {{ $category->created_at->format('h : m A') }}</p>
                                        </th>
                                        <th>
{{--                                            to edit category--}}
                                            <button class="btn btn-dark custom-btn me-2" onclick="toggle_edit({{ $category->id }})">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

{{--                                            delete category form--}}
                                            <form action="{{ route('category.destroy',$category->id) }}" method="post" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark custom-btn me-2">
                                                    <i class="text-danger bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </th>
                                    </tr>
                                    <tr class="@if(old('id') != $category->id) d-none @endif category-tr-edit" id="category-tr-edit-{{ $category->id }}">
{{--                                        update category form--}}
                                        <form action="{{ route('category.update',$category->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{ $category->id }}">
                                            <th class="d-none d-lg-table-cell mt-2">{{ $category->id }}</th>
                                            <th colspan="3">
                                                <div class="form-floating">
                                                    <input type="text" name="title" value="{{ old('id') == $category->id ? old('title') : $category->title }}" id="floatingInput-category-update"
                                                           class="form-control @if(old('id') == $category->id) @error('title') is-invalid @enderror @endif" placeholder="edit category">
                                                    @if(old('id') == $category->id)
                                                        @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    @endif
                                                    <label for="floatingInput-category-update">edit category</label>
                                                </div>
                                            </th>
                                            <th>
                                                <button type="submit" class="btn btn-dark custom-btn mt-2 me-2">
                                                    <i class="text-success bi bi-check-lg"></i>
                                                </button>
                                                <button type="button" class="btn btn-dark custom-btn mt-2" onclick="toggle_edit({{ $category->id }})">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </th>
                                        </form>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    card end--}}

@push('script')
    <script>
        // category edit button call edit form

        function toggle_edit(category_id) {
            document.getElementById('category-tr-'+category_id).classList.toggle('d-none')
            document.getElementById('category-tr-edit-' + category_id).classList.toggle('d-none')
        }

        function toggle_new(e) {
            e.children[0].classList.toggle('d-none')
            e.children[1].classList.toggle('d-none')
            document.getElementById('category-new-form').classList.toggle('d-none')
        }

        function toggle_window(e) {
            e.children[0].classList.toggle('d-none')
            e.children[1].classList.toggle('d-none')
            document.querySelector('.window-session').classList.toggle('window-expand')
        }

    </script>
@endpush
@endsection
