<?php

namespace App\Modules\Stock\Category\Provider;

use App\Modules\Stock\Category\Repository\Eloquent\Model\CategoryModelEloquent;
use App\Modules\Stock\Category\Repository\Eloquent\CategoryRepositoryEloquent;
use App\Modules\Stock\Category\Repository\CategoryRepositoryInterface;
use App\Shared\Repository\Enum\DbRepositoryEnum;
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
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => $this->app->bind(CategoryRepositoryInterface::class, fn () => new CategoryRepositoryEloquent(new CategoryModelEloquent())),
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
