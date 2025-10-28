<?php

namespace App\Providers;

use App\Services\UserService;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Services\Implementations\UserServiceImpl;
use App\Repositories\Implementations\UserRepositoryImpl;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interface với implementation
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(UserService::class,UserServiceImpl::class);
    }

    public function boot(): void
    {
        //
    }
}
