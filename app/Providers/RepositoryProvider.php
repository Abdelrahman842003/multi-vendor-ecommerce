<?php

namespace App\Providers;

use App\Http\Interface\Dashboard\CategoryInterface;
use App\Http\Interface\Dashboard\ProductInterface;
use App\Http\Interface\Dashboard\StoreInterface;
use App\Http\Interface\Frontend\HomeInterface;
use App\Http\Repository\Dashboard\CategoryRepository;
use App\Http\Repository\Dashboard\ProductRepository;
use App\Http\Repository\Dashboard\StoreRepository;
use App\Http\Repository\Frontend\HomeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // dashboard repository
        $this->app->bind(StoreInterface::class, StoreRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);

        // frontend repository
        $this->app->bind(HomeInterface::class, HomeRepository::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
