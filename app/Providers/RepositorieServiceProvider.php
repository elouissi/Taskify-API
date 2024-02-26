<?php

namespace App\Providers;

use App\Repositories\TaskRepositorie;
use App\Repositories\TaskRepositorieInterface;
use Illuminate\Support\ServiceProvider;

class RepositorieServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(TaskRepositorieInterface::class,TaskRepositorie::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
