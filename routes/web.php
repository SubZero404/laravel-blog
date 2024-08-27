<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); })->name('welcome');

Auth::routes();

//Admin dashboard

Route::middleware('auth:web')->group(function (){
    //Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //Post
    Route::resource('/post',PostController::class);

    //Category
    Route::resource('/category', CategoryController::class);

    //User
    Route::resource('/user', UserController::class);

    //Nation
    Route::resource('/nation', NationController::class);

    //photos
    Route::resource('/photo', PhotoController::class);

});

