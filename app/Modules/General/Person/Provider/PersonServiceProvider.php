<?php

namespace App\Modules\General\Person\Provider;

use App\Modules\General\Person\Repository\Eloquent\Model\PersonModelEloquent;
use App\Modules\General\Person\Repository\Eloquent\PersonRepositoryEloquent;
use App\Modules\General\Person\Repository\PersonRepositoryInterface;
use App\Shared\Repository\Enum\DbRepositoryEnum;
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
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => $this->app->bind(PersonRepositoryInterface::class, fn () => new PersonRepositoryEloquent(new PersonModelEloquent())),
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
