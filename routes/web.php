<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

Auth::routes();

//Admin dashboard
//Home
Route::get('/home', [HomeController::class, 'index'])->middleware('testing-middleware')->name('home');

//Post
Route::resource('/post',PostController::class)->middleware('auth:web');

//Category
Route::resource('/category', CategoryController::class)->middleware('auth:web');

