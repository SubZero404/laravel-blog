@extends('layouts.app')

@section('content')
    <div class="m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="bi bi-house"></i>
                    <a href="{{ route('home') }}" class=""> Home</a>
                </li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <h1 class="text-danger text-center">Categories</h1>
    </div>
@endsection
