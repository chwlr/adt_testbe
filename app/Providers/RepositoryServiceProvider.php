<?php

namespace App\Providers;

use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\Implementation\CartRepositoryImpl;
use App\Repository\Implementation\CategoryRepositoryImpl;
use App\Repository\Implementation\ProductRepositoryImpl;
use App\Repository\Implementation\UserRepositoryImpl;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use App\Services\CartService;
use App\Services\CategoryService;
use App\Services\Implementation\CartServiceImpl;
use App\Services\Implementation\CategoryServiceImpl;
use App\Services\Implementation\ProductServiceImpl;
use App\Services\Implementation\UserServiceImpl;
use App\Services\ProductService;
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
        $this->app->bind(ProductRepository::class, ProductRepositoryImpl::class);
        $this->app->bind(ProductService::class, ProductServiceImpl::class);
        $this->app->bind(CartService::class, CartServiceImpl::class);
        $this->app->bind(CartRepository::class, CartRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
