<?php

namespace App\Providers;

use App\Sale;
use App\Observers\SalesObserver;
use Illuminate\Support\ServiceProvider;

class ObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Sale::observe(SalesObserver::class);
    }
}
