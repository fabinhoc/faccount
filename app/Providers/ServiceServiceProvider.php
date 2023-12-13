<?php

namespace App\Providers;

use App\Services\AuthenticationService;
use App\Services\BillService;
use App\Services\Interfaces\AuthenticationServiceInterface;
use App\Services\Interfaces\BillServiceInterface;
use App\Services\Interfaces\NotebookServiceInterface;
use App\Services\Interfaces\TagServiceInterface;
use App\Services\NotebookService;
use App\Services\TagService;
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
        $this->app->bind(TagServiceInterface::class, TagService::class);
        $this->app->bind(BillServiceInterface::class, BillService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
