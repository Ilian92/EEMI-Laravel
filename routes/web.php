<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\BrowseController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('homepage');
    })->name('homepage');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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
});

require __DIR__ . '/auth.php';

Route::get('/parcourir', [App\Http\Controllers\CreatorController::class, 'index'])
    ->name('browse');

Route::get('/dashboard/abonnements', function () {
    $subscriptions = auth()->user()
        ->subscriptions()
        ->with('creator')
        ->paginate(10);

    return view('dashboard.abonnements', compact('subscriptions'));
})->middleware(['auth', 'verified'])
    ->name('dashboard.subscriptions');

Route::get('/{username}', [UserProfileController::class, 'show'])
    ->name('user-profile.show')
    ->where('username', '[A-Za-z0-9._-]+');
