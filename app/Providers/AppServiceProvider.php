<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Classes\ProductRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Classes\AuthRepository;
use Illuminate\Container\Attributes\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        //$this->app->bind(ProductRepositoryInterface::class, ProductRepository::class); // Duplicate, consider removing
        //$this->app->bind(AuthRepositoryInterface::class, AuthRepository::class); // Uncomment if needed
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        } 
    }

