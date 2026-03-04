<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth' && 'admin')->only('destroy');
    // }
    public function index() {
        $usersCount = User::count();
        return view('admin.dashboard' , compact('usersCount'));
    }

    public function users() {
        $users = User::paginate(5);
        return view('admin.users' , compact('users'));
    }

    // public function destroy(User $id) {
    //     if (Auth::check() && Auth::user()->role === 'admin') {
    //         $id->delete();

    //     }
    // }
}
