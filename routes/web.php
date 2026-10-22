<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;
 
Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('task_statuses', TaskStatusController::class)
    ->middleware(['auth']);

Route::resource('tasks', TaskController::class)
    ->middleware(['auth']);

Route::resource('labels', LabelController::class)
    ->middleware(['auth']);
