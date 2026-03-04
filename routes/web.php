<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// THEME ROUTE
Route::controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/' , 'index')->name('index');
    Route::get('/category/{id}' , 'category')->name('category');
    Route::get('/contact' , 'contact')->name('contact');
    // Route::get('/sigle-blog' , 'singleblog')->name('single-blog');
    // Route::get('/register' , 'register')->name('register');
    // Route::get('/login' , 'login')->name('login');
});


// SUBSCRIBER STORE ROUTE
Route::post('/subscriber/store' , [SubscriberController::class , 'store'])->name('subscriber.store');


// CONTACT STORE ROUTE
Route::post('/contact/store' , [ContactController::class , 'store'])->name('contact.store');

// COMMENT STORE ROUTE
Route::post('/comments/store' , [CommentController::class , 'store'])->name('comments.store');

// BLOG 
Route::get('/my-blogs' , [BlogController::class , 'myBlogs'])->name('blogs.my-blogs');
Route::resource('blogs' , BlogController::class);

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ROUTE ADMIN PANEL
Route::middleware(['auth' , 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard' , [AdminController::class , 'index'])->name('dashboard');
    Route::get('/users' , [AdminController::class , 'users'])->name('users');
    Route::delete('/users/{user}' , [AdminController::class , 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
