<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

Route::get('/', [TaskController::class, 'index']);

Route::resource('tasks', TaskController::class)->except(['create', 'edit', 'show']);
Route::post('tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
Route::post('/tasks/update', [TaskController::class, 'update'])->name('tasks.update');
Route::resource('projects', ProjectController::class)->except(['create', 'edit', 'show']);

