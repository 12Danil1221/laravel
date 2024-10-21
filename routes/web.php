<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');


});

Route::middleware('guest')->group(function () {
    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');

    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'loginAuth'])->name('login.auth');


});


Route::middleware('auth')->group(function () {
    Route::get('verify-email', function () {
        return view('user.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:3,1')->name('verification.send');

    Route::get('/profile', function () {
    })->middleware('verified');
});



Route::get('post', [PostController::class, 'create'])->name('post.create');
Route::post('post', [PostController::class, 'store'])->name('post.store');
Route::post('posts/{post}/register', [PostController::class, 'register2'])->name('register2')->middleware('auth');

Route::get('user/posts/{post}/edit', [PostController::class, 'edit2'])->name('user.editpost')->middleware('auth');
Route::put('user/posts/{post}', [PostController::class, 'update2'])->name('post.update')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('logout', [LogoutController::class, 'logout'])->name('user.logout');
    Route::get('admin.dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::delete('posts/{post}', [PostController::class, 'destroyAdminPost'])->name('post.destroy')->middleware('auth');
    Route::delete('posts/{post}', [PostController::class, 'destroyUserPost'])->name('post.destroy')->middleware('auth');
    Route::delete('categories/{category}', [PostController::class, 'destroyAdminCategory'])->name('category.destroy')->middleware('auth');


    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.edit')->middleware('auth');
    Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.update')->middleware('auth');
    Route::get('admin/categories/{category}/edit', [PostController::class, 'edit'])->name('admin.editcategory')->middleware('auth');
    Route::put('admin/categories/{category}', [PostController::class, 'update'])->name('admin.updatecategory')->middleware('auth');

    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth');

});