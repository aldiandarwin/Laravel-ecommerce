<?php

namespace App\Providers;

use App\Contracts\RajaOngkir\CostInterface;
use App\Contracts\RajaOngkir\LocationInterface;
use App\Services\RajaOngkir\CostService;
use App\Services\RajaOngkir\LocationService;
use Illuminate\Support\ServiceProvider;

class RajaOngkirServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CostInterface::class, CostService::class);
        $this->app->bind(LocationInterface::class, LocationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
