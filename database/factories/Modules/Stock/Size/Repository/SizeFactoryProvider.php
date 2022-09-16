<?php

namespace Database\Factories\Modules\Stock\Size\Repository;

use App\Modules\Stock\Size\Repository\Eloquent\Model\SizeModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Database\Factories\Modules\Stock\Size\Repository\Eloquent\SizeFactoryEloquent;

final class SizeFactoryProvider
{
    public static function make(DbRepositoryEnum $type = DbRepositoryEnum::NONE): SizeFactoryInterface
    {
        // Tipo de Repositório
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        if ($type !== DbRepositoryEnum::NONE) $dbRepository = $type;

        // Instanciar Factory
        return match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => new SizeFactoryEloquent(new SizeModelEloquent()),
            DbRepositoryEnum::OTHER    => null,
        };
    }
}