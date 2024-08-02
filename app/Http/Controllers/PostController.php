<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest('id')->paginate(7);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,10,"...");
        $post->category_id = $request->category;
        $post->user_id = Auth::id();
        if ($request->hasFile('feature-image')) {
            $image_file = $request->file('feature-image');
            $file_name = uniqid()."_feature_image".$image_file->extension();
            $image_file->storeAs('public',$file_name);
            $post->featured_image = $file_name;
        }
        $post->save();
        return redirect()->route('post.index')->with('status','Successfully Created Post.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,100,'...');
        $post->category_id = $request->category;
        $post->user_id = Auth::id();

        if ($request->hasFile('featured-image')) {
            $image_file = $request->file('featured-image');
            $image_name = uniqid()."featured_image".$image_file->extension();
            $image_file->storeAs('public',$image_name);
            $post->featured_image = $image_name;
        }

        $post->update();

        return redirect()->route('post.index')->with('status','Successfully Updated Post!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('status','Successfully Deleted Post!');
    }
}
