<?php

namespace App\Providers;

use App\Interfaces\ICommentService;
use App\Interfaces\IContactService;
use App\Interfaces\IExecutorService;
use App\Interfaces\OrderServiceInterface;
use App\Interfaces\IRequestOrderService;
use App\Interfaces\IRoleService;
use App\Interfaces\IUserService;
use App\Services\CommentService;
use App\Services\ContactService;
use App\Services\ExecutorService;
use App\Services\OrderService;
use App\Services\RequestOrderService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\ServiceImpl;
use App\Interfaces\IService;
use App\Services\CartServiceImpl;
use App\Interfaces\ICartService;
use App\Interfaces\IUserProfileService;
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
        $this->app->singleton(OrderServiceInterface::class, OrderService::class);
        $this->app->singleton(IUserProfileService::class, UserProfileImpl::class);
        $this->app->singleton(IUserService::class, UserService::class);
        $this->app->singleton(IRoleService::class, RoleService::class);
        $this->app->singleton(IRequestOrderService::class, RequestOrderService::class);
        $this->app->singleton(IExecutorService::class, ExecutorService::class);
        $this->app->singleton(IContactService::class, ContactService::class);
        $this->app->singleton(ICommentService::class, CommentService::class);
    }
}
