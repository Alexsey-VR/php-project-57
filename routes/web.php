<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    print_r("Привет от Хекслета!");
});

Route::get('/test-rollbar', function () {
    // Send a test log message
    \Log::debug('Test debug message from laravel');

    // Trigger a test exception
    throw new \Exception('Test exception from Laravel');

    return 'Check Rollbar for the test log and exception.';
});
