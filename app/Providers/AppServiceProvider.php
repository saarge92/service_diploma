<?php

namespace App\Providers;

use App\Interfaces\ICartService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\ServiceImpl;
use App\Interfaces\IService;
use App\Services\CartServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Binding Inversion of Control
        $this->app->bind(IService::class, ServiceImpl::class);
        $this->app->singleton(ICartService::class, CartServiceImpl::class);
        $this->app->bind('path.public', function () {
            return base_path() . '/public_html';
        });
    }
}
