<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('rollbar:test', function () {
     // Send a test log message
    \Log::debug('Test debug message from laravel');

    // Trigger a test exception
    throw new \Exception('Test exception from Laravel');
})->purpose('Check Rollbar for the test log and exception.');
