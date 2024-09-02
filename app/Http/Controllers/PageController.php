<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index()
    {
        $posts = Post::when(request('keyword'),function ($q) {
            $keyword = request('keyword');
            $q->orWhere('title','like',"%$keyword%")
                ->orWhere('description','like',"%$keyword%")
                ->orwhere('excerpt','like',"%$keyword%");
        })
            ->latest('id')
            ->with(['user','category'])
            ->paginate(10)
            ->withQueryString();
        return view('page.index',compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug',$slug)->with(['category','user','photos'])->firstOrFail();

        return view('page.show',compact('post'));
    }

    public function byUser($user_id)
    {
        // Find the user by id
        $user = User::where('id',$user_id)->firstOrFail();

        $posts = Post::where(function ($q){
            $q->when(request('keyword'),function ($q) {
                $keyword = request('keyword');
                $q->orWhere('title','like',"%$keyword%")
                    ->orWhere('description','like',"%$keyword%")
                    ->orwhere('excerpt','like',"%$keyword%");
            });
        })
            ->where('user_id',$user->id)
            ->latest('id')
            ->with(['user','category'])
            ->paginate(10)
            ->withQueryString();
        return view('page.index',compact('posts'));
    }

    public function byCategory($slug)
    {
        // Find the category by slug
        $category = Category::where('slug',$slug)->firstOrFail();

        $posts = Post::where(function ($q){
            $q->when(request('keyword'),function ($q) {
                $keyword = request('keyword');
                $q->orWhere('title','like',"%$keyword%")
                    ->orWhere('description','like',"%$keyword%")
                    ->orwhere('excerpt','like',"%$keyword%");
            });
        })
            ->where('category_id',$category->id)
            ->latest('id')
            ->with(['user','category'])
            ->paginate(10)
            ->withQueryString();
        return view('page.index',compact('posts'));
    }
}
