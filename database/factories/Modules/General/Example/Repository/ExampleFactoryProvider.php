<?php

namespace Database\Factories\Modules\General\Example\Repository;

use App\Modules\General\Example\Repository\Eloquent\Model\ExampleModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Database\Factories\Modules\General\Example\Repository\Eloquent\ExampleFactoryEloquent;

final class ExampleFactoryProvider
{
    public static function make(DbRepositoryEnum $type = DbRepositoryEnum::NONE): ExampleFactoryInterface
    {
        // Tipo de Repositório
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        if ($type !== DbRepositoryEnum::NONE) $dbRepository = $type;

        // Instanciar Factory
        return match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => new ExampleFactoryEloquent(new ExampleModelEloquent()),
            DbRepositoryEnum::OTHER    => null,
        };
    }
}