<?php

namespace App\Providers;

use App\Interfaces\IOrderService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\ServiceImpl;
use App\Interfaces\IService;
use App\Services\CartServiceImpl;
use App\Interfaces\ICartService;
use App\Interfaces\IUserProfileService;
use App\Services\OrderService;
use App\Services\UserProfileImpl;

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
     * Регистрация зависимостей
     *
     * @return void
     */
    public function register()
    {
        //Binding Inversion of Control
        $this->app->bind(IService::class, ServiceImpl::class);
        $this->app->singleton(ICartService::class, CartServiceImpl::class);
        $this->app->singleton(IOrderService::class, OrderService::class);
        $this->app->singleton(IUserProfileService::class, UserProfileImpl::class);
        $this->app->bind('path.public', function () {
            return base_path() . '/public_html';
        });
    }
}
