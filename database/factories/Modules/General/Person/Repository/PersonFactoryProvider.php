<?php

namespace Database\Factories\Modules\General\Person\Repository;

use App\Modules\General\Person\Repository\Eloquent\Model\PersonModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Database\Factories\Modules\General\Person\Repository\Eloquent\PersonFactoryEloquent;

final class PersonFactoryProvider
{
    public static function make(DbRepositoryEnum $type = DbRepositoryEnum::NONE): PersonFactoryInterface
    {
        // Tipo de Repositório
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        if ($type !== DbRepositoryEnum::NONE) $dbRepository = $type;

        // Instanciar Factory
        return match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => new PersonFactoryEloquent(new PersonModelEloquent()),
            DbRepositoryEnum::OTHER    => null,
        };
    }
}