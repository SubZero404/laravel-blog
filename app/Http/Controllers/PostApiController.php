<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
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
        return response()->json($posts);
    }
}
