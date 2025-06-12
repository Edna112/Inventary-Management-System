<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Container\Attributes\Auth;
use App\Repositories\Classes\AuthRepository;
use App\Repositories\Classes\ProductRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        //$this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        //$this->app->bind(ProductRepositoryInterface::class, ProductRepository::class); // Duplicate, consider removing
        //$this->app->bind(AuthRepositoryInterface::class, AuthRepository::class); // Uncomment if needed
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(CarbonInterval::days(15));
        Passport::refreshTokensExpireIn(CarbonInterval::days(30));
        Passport::personalAccessTokensExpireIn(CarbonInterval::seconds(15));
        // Passport::personalAccessTokensExpireIn(CarbonInterval::minutes(15));
    }
}

