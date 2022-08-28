<?php

namespace App\Modules\General\City\Provider;

use App\Modules\General\City\Repository\CityRepositoryInterface;
use App\Modules\General\City\Repository\Eloquent\CityRepositoryEloquent;
use App\Modules\General\City\Repository\Eloquent\Model\CityModelEloquent;
use Illuminate\Support\ServiceProvider;

class CityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Instanciar repositório
        match (strtolower(env('DB_REPOSITORY', 'eloquent'))) {
            'eloquent' => $this->app->bind(CityRepositoryInterface::class, fn () => new CityRepositoryEloquent(new CityModelEloquent())),
            'other'    => null,
        };        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
