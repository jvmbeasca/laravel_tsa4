<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'welcome'])->name('home');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/profile', [TaskController::class, 'profile'])->name('profile');
Route::get('/about', [TaskController::class, 'about'])->name('about');

Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::get('/tasks/archived', [TaskController::class, 'archived'])
        ->name('tasks.archived');

    Route::patch('/tasks/{task}/archive', [TaskController::class, 'archive'])
        ->name('tasks.archive');

    Route::patch('/tasks/{id}/restore', [TaskController::class, 'restore'])
        ->name('tasks.restore');

    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit');

    Route::put('/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update');
});

require __DIR__.'/auth.php';