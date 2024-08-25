<?php

namespace App\Http\Controllers;

use App\Models\Photo;
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
        //save post data to database
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = $request->excerpt;
        $post->category_id = $request->category;
        $post->user_id = Auth::id();

        //save feature image
        if ($request->hasFile('feature-image')) {
            //to storage
            $image_file = $request->file('feature-image');
            $file_name = uniqid()."_feature_image.".$image_file->extension();
            $image_file->storeAs('public',$file_name);
            //to database
            $post->featured_image = $file_name;
        }
        $post->save();

        //save post photo to database
        if ($request->hasFile('photos')) {
            foreach ($request->photos as $photo) {
                //save to storage
                $photo_name = uniqid()."_post_photo.".$photo->extension();
                $photo->storeAs('public',$photo_name);

                //save to database
                $photo = new Photo();
                $photo->name = $photo_name;
                $photo->post_id = $post->id;
                $photo->save();
            }
        }
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
            $image_name = uniqid()."featured_image.".$image_file->extension();
            $image_file->storeAs('public',$image_name);
            $post->featured_image = $image_name;
        }

//        save new photo
        if ($request->hasFile('photos')) {
            foreach ($request->photos as $photo) {
//                save to storage
                $photo_name = uniqid()."_post_photo.".$photo->extension();
                $photo->storeAs('public/',$photo_name);

//                save to databse
                $photo = new Photo();
                $photo->name = $photo_name;
                $photo->post_id = $post->id;
                $photo->save();
            }
        }

//        delete old photo

        if ($request->has('delete_old_photos')) {
            foreach ($request->delete_old_photos as $photo_id) {
                $photo_name = 'public/'.$post->photos->whereIn('id',$photo_id)->first()->name;

                if (Storage::has($photo_name)) {
                    Storage::delete($photo_name);
                }
                $photo = Photo::find($photo_id);
                if ($photo) {
                    $photo->delete();
                }
                logger($photo);
            }

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

        foreach ($post->photos as $photo) {
            $photo_name = 'public/'.$photo->name;
            if (Storage::has($photo_name)) {
                Storage::delete($photo_name);
            }
        }

        $post->delete();
        return redirect()->route('post.index')->with('status','Successfully Deleted Post!');
    }
}
