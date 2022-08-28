<?php

namespace App\Modules\Stock\Size\Provider;

use App\Modules\Stock\Size\Repository\Eloquent\Model\SizeModelEloquent;
use App\Modules\Stock\Size\Repository\Eloquent\SizeRepositoryEloquent;
use App\Modules\Stock\Size\Repository\SizeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class SizeServiceProvider extends ServiceProvider
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
            'eloquent' => $this->app->bind(SizeRepositoryInterface::class, fn () => new SizeRepositoryEloquent(new SizeModelEloquent())),
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
