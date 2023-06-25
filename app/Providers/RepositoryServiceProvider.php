<?php

namespace App\Providers;

use App\Repository\CategoryRepository;
use App\Repository\Implementation\CategoryRepositoryImpl;
use App\Repository\Implementation\UserRepositoryImpl;
use App\Repository\UserRepository;
use App\Services\CategoryService;
use App\Services\Implementation\CategoryServiceImpl;
use App\Services\Implementation\UserServiceImpl;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryImpl::class);
        $this->app->bind(CategoryService::class, CategoryServiceImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
