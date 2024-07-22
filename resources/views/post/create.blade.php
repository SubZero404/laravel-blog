@extends('layouts.app')

@section('content')
    <div class="m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house"></i>
                    <a href="{{ route('home') }}" class=""> Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('post.create') }}" class=""> Post</a>
                </li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <h1 class="text-danger text-center">Create Post</h1>
    </div>
@endsection
