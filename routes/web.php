<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    
    return view('welcome');
})->name('index')->middleware('auth');

Route::get('/home', function () {
    return redirect()->route('index');
})->name('home');

Route::get('/test-rollbar', function () {
    // Send a test log message
    \Log::debug('Test debug message from laravel');

    // Trigger a test exception
    throw new \Exception('Test exception from Laravel');

    return 'Check Rollbar for the test log and exception.';
});
