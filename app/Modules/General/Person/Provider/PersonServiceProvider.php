<?php

namespace App\Modules\General\Person\Provider;

use App\Modules\General\Person\Repository\Eloquent\Model\PersonModelEloquent;
use App\Modules\General\Person\Repository\Eloquent\PersonRepositoryEloquent;
use App\Modules\General\Person\Repository\PersonRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PersonServiceProvider extends ServiceProvider
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
            'eloquent' => $this->app->bind(PersonRepositoryInterface::class, fn () => new PersonRepositoryEloquent(new PersonModelEloquent())),
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
