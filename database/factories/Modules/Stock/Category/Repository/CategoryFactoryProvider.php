<?php

namespace Database\Factories\Modules\Stock\Category\Repository;

use App\Modules\Stock\Category\Repository\Eloquent\Model\CategoryModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Database\Factories\Modules\Stock\Category\Repository\Eloquent\CategoryFactoryEloquent;

final class CategoryFactoryProvider
{
    public static function make(DbRepositoryEnum $type = DbRepositoryEnum::NONE): CategoryFactoryInterface
    {
        // Tipo de Repositório
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        if ($type !== DbRepositoryEnum::NONE) $dbRepository = $type;

        // Instanciar Factory
        return match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => new CategoryFactoryEloquent(new CategoryModelEloquent()),
            DbRepositoryEnum::OTHER    => null,
        };
    }
}