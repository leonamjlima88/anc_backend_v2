<?php

namespace App\Modules\Stock\StorageLocation\Provider;

use App\Modules\Stock\StorageLocation\Repository\Eloquent\Model\StorageLocationModelEloquent;
use App\Modules\Stock\StorageLocation\Repository\Eloquent\StorageLocationRepositoryEloquent;
use App\Modules\Stock\StorageLocation\Repository\StorageLocationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class StorageLocationServiceProvider extends ServiceProvider
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
            'eloquent' => $this->app->bind(StorageLocationRepositoryInterface::class, fn () => new StorageLocationRepositoryEloquent(new StorageLocationModelEloquent())),
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
