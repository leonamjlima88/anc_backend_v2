<?php

namespace Database\Factories\Modules\Stock\Unit\Repository;

use App\Modules\Stock\Unit\Repository\Eloquent\Model\UnitModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Database\Factories\Modules\Stock\Unit\Repository\Eloquent\UnitFactoryEloquent;

final class UnitFactoryProvider
{
    public static function make(DbRepositoryEnum $type = DbRepositoryEnum::NONE): UnitFactoryInterface
    {
        // Tipo de Repositório
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        if ($type !== DbRepositoryEnum::NONE) $dbRepository = $type;

        // Instanciar Factory
        return match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => new UnitFactoryEloquent(new UnitModelEloquent()),
            DbRepositoryEnum::OTHER    => null,
        };
    }
}