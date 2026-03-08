<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        $usersCount = User::count();
        return view('admin.dashboard' , compact('usersCount'));
    }

    public function create() {
        return view('admin.create_user');
    }

    public function store(StoreUserRequest $request) {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success' , 'User created successfully.');
    }
    

    public function users() {
        $users = User::paginate(5);
        return view('admin.users' , compact('users'));
    }

    public function destroy(User $user) {

        if ($user->role === 'admin' && auth()->id() !== 5) {
            return back()->with('ErrorDeleteAdmin', 'Sorry, only the main owner can delete other admins!');
        }
        if (auth()->id() === $user->id) {
        return back()->with('ErrorDeleteAdmin', 'You cannot delete yourself!');
        }
        $user->delete();
        return back()->with('UserDeleteStatus', 'User deleted successfully.');
        
    }

    public function edit(User $user) {
        return view('admin.user_edit' , compact('user'));
    }

    public function update(UpdateUserRequest $request , User $user) {
        if ($user->role === 'admin' && auth()->id() !== 5 && auth()->id() !== $user->id) {
            return back()->with('ErrorDeleteAdmin' , 'Sorry, only the primary owner can edit other managers!');
        }
        if(auth()->id() === $user->id && $request->role === 'user') {
            return back()->with('error' , 'Sorry, you cannot revoke your own management privileges!');
        }

        $user->update($request->validated());

        return redirect()->route('admin.users.index')->with('UserUpdateStatus' , 'User data updated successfully.');
    }







}
