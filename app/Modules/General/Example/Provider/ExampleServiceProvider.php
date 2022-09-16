<?php

namespace App\Modules\General\Example\Provider;

use App\Modules\General\Example\Repository\Eloquent\Model\ExampleModelEloquent;
use App\Modules\General\Example\Repository\Eloquent\ExampleRepositoryEloquent;
use App\Modules\General\Example\Repository\ExampleRepositoryInterface;
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
        $dbRepository = strtolower(env('DB_REPOSITORY', 'eloquent'));
        match ($dbRepository) {
            'eloquent' => $this->app->bind(ExampleRepositoryInterface::class, fn () => new ExampleRepositoryEloquent(new ExampleModelEloquent())),
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
