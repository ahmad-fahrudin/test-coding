<?php

namespace App\Providers;

use App\Services\KelasService;
use App\Services\SiswaService;
use App\Repositories\KelasRepository;
use App\Repositories\SiswaRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\KelasRepositoryInterface;
use App\Repositories\Interfaces\SiswaRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(KelasRepositoryInterface::class, KelasRepository::class);
        $this->app->bind(KelasService::class);
        $this->app->bind(SiswaRepositoryInterface::class, SiswaRepository::class);
        $this->app->bind(SiswaService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
