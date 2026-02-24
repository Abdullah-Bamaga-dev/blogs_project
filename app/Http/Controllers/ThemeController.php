<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index() {
        $blogs = Blog::with('user')->paginate(4);
        return view('theme.index' , compact('blogs'));
    }

    public function category() {
        return view('theme.category');
    }

    public function contact() {
        return view('theme.contact');
    }

    public function singleblog() {
        return view('theme.singleblog');
    }

    public function register() {
        return view('theme.register');
    }

    public function login() {
        return view('theme.login');
    }
}
