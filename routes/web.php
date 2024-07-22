<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

Auth::routes();

//Admin dashboard
//Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Post
Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/post/show', [PostController::class, 'show'])->name('post.show');
Route::get('/post/edit', [PostController::class, 'edit'])->name('post.edit');

//Category
Route::get('/category', [CategoryController::class, 'index'])->name('category');
