<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\LivrosRepository;
use App\Repositories\LivrosRepositoryInterface;
use App\Services\LivrosServices;
use App\Repositories\IndicesRepository;
use App\Repositories\IndicesRepositoryInterface;
use App\Services\IndicesServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LivrosRepositoryInterface::class, LivrosRepository::class);
        $this->app->singleton(LivrosServices::class, function ($app) {
            return new LivrosServices($app->make(LivrosRepositoryInterface::class));
        });

        $this->app->singleton(IndicesRepositoryInterface::class, IndicesRepository::class);
        $this->app->singleton(IndicesServices::class, function ($app) {
            return new IndicesServices($app->make(IndicesRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
