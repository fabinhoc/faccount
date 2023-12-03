<?php

namespace App\Providers;

use App\Services\AuthenticationService;
use App\Services\Interfaces\AuthenticationServiceInterface;
use App\Services\Interfaces\NotebookServiceInterface;
use App\Services\NotebookService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
        $this->app->bind(NotebookServiceInterface::class, NotebookService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
