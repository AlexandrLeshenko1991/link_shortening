<?php

namespace App\Providers;

use App\Repositories\EloquentLink;
use App\Repositories\EloquentLinkQueries;
use App\Repositories\Interfaces\LinkQueries;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Repositories\Interfaces\LinkRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LinkQueries::class,
            EloquentLinkQueries::class);

        $this->app->bind(LinkRepository::class,
            EloquentLink::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

    }
}
