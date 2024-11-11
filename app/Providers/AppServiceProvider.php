<?php

namespace App\Providers;

use App\Services\GuruService;
use App\Services\KelasService;
use App\Services\SiswaService;
use App\Services\OrangTuaService;
use App\Repositories\GuruRepository;
use App\Repositories\KelasRepository;
use App\Repositories\SiswaRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\OrangTuaRepository;
use App\Repositories\Interfaces\GuruRepositoryInterface;
use App\Repositories\Interfaces\KelasRepositoryInterface;
use App\Repositories\Interfaces\SiswaRepositoryInterface;
use App\Repositories\Interfaces\OrangTuaRepositoryInterface;

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
        $this->app->bind(GuruRepositoryInterface::class, GuruRepository::class);
        $this->app->bind(GuruService::class);
        $this->app->bind(OrangTuaRepositoryInterface::class, OrangTuaRepository::class);
        $this->app->bind(OrangTuaService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
