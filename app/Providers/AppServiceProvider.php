<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TaskAssignmentService;
use App\Services\TaskAssignmentServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TaskAssignmentServiceInterface::class, TaskAssignmentService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
