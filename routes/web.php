<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('task_statuses', TaskStatusController::class)
    ->middleware(['auth']);

Route::resource('tasks', TaskController::class)
    ->except(['index', 'show'])
    ->middleware(['auth']);

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/show/{task}', [TaskController::class, 'show'])->name('tasks.show');

Route::resource('labels', LabelController::class)
    ->except(['index', 'show'])
    ->middleware(['auth']);

Route::get('/labels', [LabelController::class, 'index'])->name('labels.index');
Route::get('/labels/{label}', [LabelController::class, 'show'])->name('labels.show');
