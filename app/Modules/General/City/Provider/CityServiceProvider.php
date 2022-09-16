<?php

namespace App\Modules\General\City\Provider;

use App\Modules\General\City\Repository\CityRepositoryInterface;
use App\Modules\General\City\Repository\Eloquent\CityRepositoryEloquent;
use App\Modules\General\City\Repository\Eloquent\Model\CityModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
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
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => $this->app->bind(CityRepositoryInterface::class, fn () => new CityRepositoryEloquent(new CityModelEloquent())),
            DbRepositoryEnum::OTHER    => null,
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
