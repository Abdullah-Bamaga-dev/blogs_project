<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth')->only(['create' , 'myBlogs' , 'store' , 'edit' , 'update']);
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
        $blog->load('comments');
        return view('theme.singleblog' , compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {
            $categories = Category::get();
            return view('theme.blogs.edit' , compact('categories' , 'blog'));
        }
        abort(403, 'Unauthorized action.');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {

            $data = $request->validated();
    
            if ($request->hasFile('image')) {
    
                //image uploading 
                // delete old image
                Storage::delete("public/blogs/$blog->image");
                // get image 
                $image = $request->image;
                // change it`s current name
                $newImageName = time().'-'.$image->getClientOriginalName();
                // move image to my project
                $image->storeAs('blogs' , $newImageName , 'public');
                // save new name to database record
                $data['image'] = $newImageName;
            }
    
            $blog->update($data);
    
            return back()->with('BlogUpdateStatus' , 'your blog Updated successfully');
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {
            Storage::delete("public/blogs/$blog->image");
            $blog->delete();
            return back()->with('BlogDeleteStatus' , 'your blog Deleted successfully');
        }
        abort(403);
    }

    // display all user blogs
    public function myBlogs() {
            $blogs = Blog::where('user_id' , Auth::user()->id)->paginate(10);
            return view('theme.blogs.my-blogs' , compact('blogs'));
            
    }
}
