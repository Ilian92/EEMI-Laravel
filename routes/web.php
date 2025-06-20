<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\BrowseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('homepage');
    })->name('homepage');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/todo', [TodoController::class, 'add'])->name('todo.add');
    Route::delete('/todo/{todo}', [TodoController::class, 'delete'])->name('todo.delete');
    Route::get('/todo/{todo}', [TodoController::class, 'view'])->name('todo.view');
    Route::get('/todo/{todo}/update', [TodoController::class, 'updateform'])->name('todo.updateform');
    Route::post('/todo/{todo}/update', [TodoController::class, 'update'])->name('todo.update');

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/{creator}/subscribe', [UserProfileController::class, 'subscribe'])
        ->name('user-profile.subscribe');
    Route::post('/profile/{creator}/unsubscribe', [UserProfileController::class, 'unsubscribe'])
        ->name('user-profile.unsubscribe');

    Route::post('/creator/become', [App\Http\Controllers\CreatorController::class, 'become'])
        ->name('creator.become');

    Route::patch('/creator/remove', [App\Http\Controllers\CreatorController::class, 'remove'])
        ->name('creator.remove');

    Route::get('/dashboard/abonnements', [DashboardController::class, 'subscriptions'])
        ->name('dashboard.subscriptions');

    Route::get('/dashboard/stats', [DashboardController::class, 'stats'])
        ->middleware('can:isCreator')
        ->name('dashboard.stats');
});

require __DIR__ . '/auth.php';

Route::get('/parcourir', [App\Http\Controllers\CreatorController::class, 'index'])
    ->name('browse');

Route::get('/{username}', [UserProfileController::class, 'show'])
    ->name('user-profile.show')
    ->where('username', '[A-Za-z0-9._-]+');
