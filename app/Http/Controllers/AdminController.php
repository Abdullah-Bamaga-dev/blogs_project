<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        $usersCount = User::count();
        return view('admin.dashboard' , compact('usersCount'));
    }

    public function users() {
        $users = User::paginate(5);
        return view('admin.users' , compact('users'));
    }

    public function destroy(User $user) {

        if (auth()->id() === $user->id) {
        return back()->with('ErrorDeleteAdmin', 'You cannot delete yourself!');
        }

        $user->delete();
        return back()->with('UserDeleteStatus', 'User deleted successfully.');
        
    }
}
