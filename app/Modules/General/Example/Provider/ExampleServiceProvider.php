<?php

namespace App\Modules\General\Example\Provider;

use App\Modules\General\Example\Repository\Eloquent\Model\ExampleModelEloquent;
use App\Modules\General\Example\Repository\Eloquent\ExampleRepositoryEloquent;
use App\Modules\General\Example\Repository\ExampleRepositoryInterface;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Illuminate\Support\ServiceProvider;

class ExampleServiceProvider extends ServiceProvider
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
            DbRepositoryEnum::ELOQUENT => $this->app->bind(ExampleRepositoryInterface::class, fn () => new ExampleRepositoryEloquent(new ExampleModelEloquent())),
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
