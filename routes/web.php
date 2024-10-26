<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TodoListController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/todo-list/data', [TodoListController::class, 'getData'])->middleware(['auth', 'verified'])->name('todoListData');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('todo', TodoListController::class);
});

require __DIR__.'/auth.php';
