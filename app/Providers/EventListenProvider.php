<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\Events\MessageSending;
use App\Listeners\LogMailListener;

class EventListenProvider extends ServiceProvider
{
    /**
     * Event listener mapping
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        MessageSent::class => [LogMailListener::class],
        MessageSending::class => [LogMailListener::class]
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
