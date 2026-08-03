<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('users.create');
});

Route::get('/test-rollbar', function () {
    // Send a test log message
    \Log::debug('Test debug message from laravel');

    // Trigger a test exception
    throw new \Exception('Test exception from Laravel');

    return 'Check Rollbar for the test log and exception.';
});

Route::resource('users', UserController::class)
    ->only(['create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middlewareFor(['show', 'edit', 'update', 'destroy'], 'auth');
