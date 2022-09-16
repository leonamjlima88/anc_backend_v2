<?php

namespace Database\Factories\Modules\Stock\StorageLocation\Repository;

use App\Modules\Stock\StorageLocation\Repository\Eloquent\Model\StorageLocationModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Database\Factories\Modules\Stock\StorageLocation\Repository\Eloquent\StorageLocationFactoryEloquent;

final class StorageLocationFactoryProvider
{
    public static function make(DbRepositoryEnum $type = DbRepositoryEnum::NONE): StorageLocationFactoryInterface
    {
        // Tipo de Repositório
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        if ($type !== DbRepositoryEnum::NONE) $dbRepository = $type;

        // Instanciar Factory
        return match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => new StorageLocationFactoryEloquent(new StorageLocationModelEloquent()),
            DbRepositoryEnum::OTHER    => null,
        };
    }
}