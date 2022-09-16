<?php

namespace App\Modules\Stock\Unit\Provider;

use App\Modules\Stock\Unit\Repository\Eloquent\Model\UnitModelEloquent;
use App\Modules\Stock\Unit\Repository\Eloquent\UnitRepositoryEloquent;
use App\Modules\Stock\Unit\Repository\UnitRepositoryInterface;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Illuminate\Support\ServiceProvider;

class UnitServiceProvider extends ServiceProvider
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
            DbRepositoryEnum::ELOQUENT => $this->app->bind(UnitRepositoryInterface::class, fn () => new UnitRepositoryEloquent(new UnitModelEloquent())),
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
