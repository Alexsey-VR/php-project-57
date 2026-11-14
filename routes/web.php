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

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/show/{task}', [TaskController::class, 'show'])->name('tasks.show');

Route::resource('tasks', TaskController::class)
    ->except(['index', 'show'])
    ->middleware(['auth']);

Route::resource('labels', LabelController::class)
    ->middleware(['auth']);
