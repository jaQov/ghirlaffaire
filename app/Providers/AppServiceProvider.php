<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Models\DeliveryCompany;
use App\Observers\DeliveryObserver;
use App\Models\Order;
use App\Observers\OrderObserver;


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
        DeliveryCompany::observe(DeliveryObserver::class);
        Order::observe(OrderObserver::class);
    }
}
