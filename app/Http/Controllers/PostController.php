<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::when(request('keyword'),function ($q) {
            $keyword = request('keyword');
            $q->orWhere('title','like',"%$keyword%")->orWhere('description','like',"%$keyword%");
        })
            ->when(Auth::user()->isAuthor(),fn($q)=>$q->where('user_id',Auth::id()))
            ->latest('id')
            ->paginate(7)
            ->withQueryString();
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
        $post->excerpt = $request->excerpt;
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
        if (Gate::denies('view',$post)) {
            return abort(403);
        }
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Gate::denies('update',$post)) {
            return abort(403);
        }
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if (Gate::denies('update',$post)) {
            return abort(403);
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = $request->excerpt;
        $post->category_id = $request->category;
        $post->user_id = Auth::id();

        if ($request->hasFile('featured-image')) {
//            delete old photo from storage
            Storage::delete("public/".$post->featured_image);

//            add new photo
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
        if (Gate::denies('delete',$post)) {
            return abort(403);
        }
        if (isset($post->featured_image)) {
           $featured_image = 'public/'.$post->featured_image;
            if (Storage::has($featured_image)) {
                Storage::delete($featured_image);
            }
        }

        $post->delete();
        return redirect()->route('post.index')->with('status','Successfully Deleted Post!');
    }
}
