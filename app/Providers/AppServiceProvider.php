<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\TransactionRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
