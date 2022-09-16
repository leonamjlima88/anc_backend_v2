<?php

namespace App\Modules\Stock\Brand\Provider;

use App\Modules\Stock\Brand\Repository\Eloquent\Model\BrandModelEloquent;
use App\Modules\Stock\Brand\Repository\Eloquent\BrandRepositoryEloquent;
use App\Modules\Stock\Brand\Repository\BrandRepositoryInterface;
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
        $dbRepository = strtolower(env('DB_REPOSITORY', 'eloquent'));
        match ($dbRepository) {
            'eloquent' => $this->app->bind(BrandRepositoryInterface::class, fn () => new BrandRepositoryEloquent(new BrandModelEloquent())),
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
