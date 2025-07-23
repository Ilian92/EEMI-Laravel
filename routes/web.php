<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\BrowseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\GuessController;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/todo', [TodoController::class, 'add'])->name('todo.add');
    Route::delete('/todo/{todo}', [TodoController::class, 'delete'])->name('todo.delete');
    Route::get('/todo/{todo}', [TodoController::class, 'view'])->name('todo.view');
    Route::get('/todo/{todo}/update', [TodoController::class, 'updateform'])->name('todo.updateform');
    Route::post('/todo/{todo}/update', [TodoController::class, 'update'])->name('todo.update');

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

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');

    Route::post('/guess', [GuessController::class, 'submit'])->name('guess.submit');
    Route::get('/guess', [GuessController::class, 'index'])->name('guess.index');
    Route::post('/guess/reset-score', [GuessController::class, 'resetScore'])->name('guess.reset-score');
    Route::get('/test-reset', function () {
        dd('Route de test atteinte !');
    });

    Route::post('/test-reset-post', function () {
        dd('Route POST de test atteinte !');
    });


});

require __DIR__ . '/auth.php';


Route::get('/parcourir', [App\Http\Controllers\CreatorController::class, 'index'])
    ->name('browse');

Route::get('/{username}', [UserProfileController::class, 'show'])
    ->name('user-profile.show')
    ->where('username', '[A-Za-z0-9._-]+');

