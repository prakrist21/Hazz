<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SavedPostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Likes
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');

    // Replies
    Route::post('/posts/{post}/replies', [ReplyController::class, 'store'])->name('replies.store');
    Route::delete('/replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy');

    // Saved
    Route::post('/posts/{post}/save', [SavedPostController::class, 'toggle'])->name('posts.save');
    Route::get('/saved', [SavedPostController::class, 'index'])->name('saved.index');

    //User Profile
    Route::get('/users/{user}', [UserProfileController::class, 'show'])->name('profile.show');


    // Follow
    Route::post('/users/{user}/follow', [FollowController::class, 'toggle'])->name('users.follow');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});

require __DIR__.'/auth.php';