<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskStatusController;

Route::get('/home', function () {
    return view('page.home');
})->name('page.home')->middleware('auth');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('page.home');
    }
    return view('index');
})->name('index');

Route::get('/test-rollbar', function () {
    // Send a test log message
    \Log::debug('Test debug message from laravel');

    // Trigger a test exception
    throw new \Exception('Test exception from Laravel');

    return 'Check Rollbar for the test log and exception.';
});

Route::resource('task_statuses', TaskStatusController::class)
    ->middleware(['auth']);
