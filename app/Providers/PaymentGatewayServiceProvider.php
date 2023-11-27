<?php

namespace App\Providers;

use App\Contracts\Midtrans\TransactionInterface;
use App\Services\Midtrans\TransactionService;
use Illuminate\Support\ServiceProvider;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TransactionInterface::class, TransactionService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
