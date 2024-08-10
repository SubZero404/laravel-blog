<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

Auth::routes();

//Admin dashboard

Route::middleware('auth:web')->group(function (){
    //Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //Post
    Route::resource('/post',PostController::class);

    //Category
    Route::resource('/category', CategoryController::class);
});

