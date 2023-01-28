<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindRepositories();
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

    protected function bindRepositories()
    {
        $this->app->bind(
            \App\Contracts\PeopleContract::class,
            fn ($app) =>   new \App\Repositories\People\PeopleRepository(
                new \App\Models\People\People()
            )
        );

        $this->app->bind(
            \App\Contracts\SpeciesContract::class,
            fn ($app) =>   new \App\Repositories\Species\SpeciesRepository(
                new \App\Models\Species\Species()
            )
        );

        $this->app->bind(
            \App\Contracts\VehicleContract::class,
            fn ($app) =>   new \App\Repositories\Vehicle\VehicleRepository(
                new \App\Models\Vehicle\Vehicle(),
            )
        );
    }
}
