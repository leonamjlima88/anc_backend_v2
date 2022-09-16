<?php

namespace Database\Factories\Modules\General\City\Repository;

use App\Modules\General\City\Repository\Eloquent\Model\CityModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Database\Factories\Modules\General\City\Repository\Eloquent\CityFactoryEloquent;

final class CityFactoryProvider
{
    public static function make(DbRepositoryEnum $type = DbRepositoryEnum::NONE): CityFactoryInterface
    {
        // Tipo de Repositório
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        if ($type !== DbRepositoryEnum::NONE) $dbRepository = $type;

        // Instanciar Factory
        return match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => new CityFactoryEloquent(new CityModelEloquent()),
            DbRepositoryEnum::OTHER    => null,
        };
    }
}