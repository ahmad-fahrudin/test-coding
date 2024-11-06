<?php

namespace App\Providers;

use App\Services\KelasService;
use App\Repositories\KelasRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\KelasRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(KelasRepositoryInterface::class, KelasRepository::class);
        $this->app->bind(KelasService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
