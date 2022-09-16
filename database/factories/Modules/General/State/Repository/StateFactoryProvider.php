<?php

namespace Database\Factories\Modules\General\State\Repository;

use App\Modules\General\State\Repository\Eloquent\Model\StateModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Database\Factories\Modules\General\State\Repository\Eloquent\StateFactoryEloquent;

final class StateFactoryProvider
{
    public static function make(DbRepositoryEnum $type = DbRepositoryEnum::NONE): StateFactoryInterface
    {
        // Tipo de Repositório
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        if ($type !== DbRepositoryEnum::NONE) $dbRepository = $type;

        // Instanciar Factory
        return match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => new StateFactoryEloquent(new StateModelEloquent()),
            DbRepositoryEnum::OTHER    => null,
        };
    }
}