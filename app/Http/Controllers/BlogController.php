<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth')->only(['create' , 'myBlogs']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Auth::check()) {
        //     }
        //     abort(403);
            $categories = Category::get();
            return view('theme.blogs.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();

        //image uploading 
        // get image 
        $image = $request->image;
        // change it`s current name
        $newImageName = time().'-'.$image->getClientOriginalName();
        // move image to my project
        $image->storeAs('blogs' , $newImageName , 'public');
        // save new name to database record
        $data['image'] = $newImageName;
        $data['user_id'] = Auth::user()->id;

        Blog::create($data);

        return back()->with('BlogCreateStatus' , 'your blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.singleblog' , compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }

    // display all user blogs
    public function myBlogs() {
            $blogs = Blog::where('user_id' , Auth::user()->id)->paginate(10);
            return view('theme.blogs.my-blogs' , compact('blogs'));
    }
}
