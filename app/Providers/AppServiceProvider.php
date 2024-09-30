<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Business;

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
        

        \Cache::rememberForever('info', function() {

            return Business::first()->toArray();
        });

        $new=\Cache::get('info');
        Paginator::useBootstrap();
    }
}
