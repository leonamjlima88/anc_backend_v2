<?php

namespace App\Modules\Stock\Category\Provider;

use App\Modules\Stock\Category\Repository\Eloquent\Model\CategoryModelEloquent;
use App\Modules\Stock\Category\Repository\Eloquent\CategoryRepositoryEloquent;
use App\Modules\Stock\Category\Repository\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
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
            'eloquent' => $this->app->bind(CategoryRepositoryInterface::class, fn () => new CategoryRepositoryEloquent(new CategoryModelEloquent())),
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
