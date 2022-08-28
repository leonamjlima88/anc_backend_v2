<?php

namespace App\Modules\General\State\Provider;

use App\Modules\General\State\Repository\Eloquent\Model\StateModelEloquent;
use App\Modules\General\State\Repository\Eloquent\StateRepositoryEloquent;
use App\Modules\General\State\Repository\StateRepositoryInterface;
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
        match (strtolower(env('DB_REPOSITORY', 'eloquent'))) {
            'eloquent' => $this->app->bind(StateRepositoryInterface::class, fn () => new StateRepositoryEloquent(new StateModelEloquent())),
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
