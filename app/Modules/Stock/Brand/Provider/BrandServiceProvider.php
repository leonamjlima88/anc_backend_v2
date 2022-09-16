<?php

namespace App\Modules\Stock\Brand\Provider;

use App\Modules\Stock\Brand\Repository\Eloquent\Model\BrandModelEloquent;
use App\Modules\Stock\Brand\Repository\Eloquent\BrandRepositoryEloquent;
use App\Modules\Stock\Brand\Repository\BrandRepositoryInterface;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Illuminate\Support\ServiceProvider;

class BrandServiceProvider extends ServiceProvider
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
            DbRepositoryEnum::ELOQUENT => $this->app->bind(BrandRepositoryInterface::class, fn () => new BrandRepositoryEloquent(new BrandModelEloquent())),
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
