<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\{Auth, Gate};
use App\Models\{Task, TaskStatus, Label};
use App\Policies\{TaskStatusPolicy, LabelPolicy};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('user', Auth::user());

        Gate::policy(TaskStatus::class, TaskStatusPolicy::class);
        Gate::policy(Label::class, LabelPolicy::class);
    }
}
