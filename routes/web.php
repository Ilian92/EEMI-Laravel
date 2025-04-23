<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/todo', [\App\Http\Controllers\TodoController::class, 'index'])->name('todo.index');
Route::post('/todo', [\App\Http\Controllers\TodoController::class, 'add'])->name('todo.add');
Route::delete('/todo/{todo}', [\App\Http\Controllers\TodoController::class, 'delete'])->name('todo.delete');
Route::get('/todo/{todo}', [\App\Http\Controllers\TodoController::class, 'view'])->name('todo.view');
Route::get('/todo/{todo}/update', [\App\Http\Controllers\TodoController::class, 'updateform'])->name('todo.updateform');
Route::post('/todo/{todo}/update', [\App\Http\Controllers\TodoController::class, 'update'])->name('todo.update');

require __DIR__ . '/auth.php';
