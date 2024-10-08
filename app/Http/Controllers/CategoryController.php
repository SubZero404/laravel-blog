<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        if (Gate::denies('view',$category)) {
            return abort(403);
        }
        $categories = Category::latest("id")->with(['user'])->get();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('category.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request,Category  $category)
    {
        if (Gate::denies('create',$category)) {
            return abort(403);
        }
        $title = $request->title;
        $slug = Str::slug($title);
        $category = new Category();
        $category->title = $title;
        $category->slug = $slug;
        $category->user_id = Auth::id();
        $category->save();
        return redirect()->route('category.index')->with('status','Category Successfully Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return redirect()->route('category.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if (Gate::denies('update',$category)) {
            return abort(403);
        }
        $title = $request->title;
        $slug = Str::slug($title);
        $category->title = $title;
        $category->slug = $slug;
//        $category->user_id = Auth::id();
        $category->update();
        return redirect()->route('category.index')->with('status','Successfully Updated Category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Gate::denies('delete',$category)) {
            return abort(403);
        }
        $category->delete();
        return redirect()->route('category.index')->with('status','Category Successfully Deleted');
    }
}
