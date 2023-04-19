<?php

namespace App\Providers;

use App\Repositories\ItemRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserServices;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ItemRepositoryInterface::class);

        $this->app->bind(OrderRepositoryInterface::class);

        $this->app->bind(UserRepositoryInterface::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
