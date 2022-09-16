<?php

namespace App\Modules\General\State\Provider;

use App\Modules\General\State\Repository\Eloquent\Model\StateModelEloquent;
use App\Modules\General\State\Repository\Eloquent\StateRepositoryEloquent;
use App\Modules\General\State\Repository\StateRepositoryInterface;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Illuminate\Support\ServiceProvider;

class StateServiceProvider extends ServiceProvider
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
            DbRepositoryEnum::ELOQUENT => $this->app->bind(StateRepositoryInterface::class, fn () => new StateRepositoryEloquent(new StateModelEloquent())),
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
