<?php

namespace App\Providers;

use App\Models\Task;
use App\Repositories\TaskRepositorie;
use App\Repositories\TaskRepositorieInterface;
use App\Repositories\UserRepositorie;
use App\Repositories\UserRepositorieInterface;
use Illuminate\Support\ServiceProvider;
use App\Policies\TaskPolicy;
use Illuminate\Support\Facades\Gate;

class RepositorieServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TaskRepositorieInterface::class,TaskRepositorie::class);
        $this->app->bind(UserRepositorieInterface::class, UserRepositorie::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::policy(Task::class, TaskPolicy::class);
    }

    /**
     * Define your policy mappings.
     *
     * @return void
     */
    protected function registerPolicies()
    {
        Gate::define('task', [TaskPolicy::class, 'view']);
    }
}
