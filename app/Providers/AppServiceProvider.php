<?php

namespace App\Providers;

use App\Services\IUserService;
use App\Services\IOrderService;
use App\Services\IProductService;
use App\Services\ICustomerService;
use App\Repositories\IUserRepository;
use App\Repositories\IOrderRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\IProductRepository;
use App\Repositories\ICustomerRepository;
use App\Services\Implementations\UserServiceImpl;
use App\Services\Implementations\OrderServiceImpl;
use App\Services\Implementations\ProductServiceImpl;
use App\Services\Implementations\CustomerServiceImpl;
use App\Repositories\Implementations\UserRepositoryImpl;
use App\Repositories\Implementations\OrderRepositoryImpl;
use App\Repositories\Implementations\ProductRepositoryImpl;
use App\Repositories\Implementations\CustomerRepositoryImpl;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interface với implementation
        $this->app->bind(IUserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(IUserService::class,UserServiceImpl::class);

        $this->app->bind(ICustomerRepository::class,CustomerRepositoryImpl::class);
        $this->app->bind(ICustomerService::class,CustomerServiceImpl::class);

        $this->app->bind(IProductService::class,ProductServiceImpl::class);
        $this->app->bind(IProductRepository::class,ProductRepositoryImpl::class);

        $this->app->bind(IOrderService::class,OrderServiceImpl::class);
        $this->app->bind(IOrderRepository::class,OrderRepositoryImpl::class);
        
    }

    public function boot(): void
    {
        //
    }
}
