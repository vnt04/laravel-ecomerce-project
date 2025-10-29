<?php

namespace App\Providers;

use App\Services\IUserService;
use App\Services\ICustomerService;
use App\Repositories\IUserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ICustomerRepository;
use App\Services\Implementations\CustomerServiceImpl;
use App\Services\Implementations\UserServiceImpl;
use App\Repositories\Implementations\CustomerRepositoryImpl;
use App\Repositories\Implementations\UserRepositoryImpl;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interface với implementation
        $this->app->bind(IUserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(IUserService::class,UserServiceImpl::class);
        $this->app->bind(ICustomerRepository::class,CustomerRepositoryImpl::class);
        $this->app->bind(ICustomerService::class,CustomerServiceImpl::class);
    }

    public function boot(): void
    {
        //
    }
}
