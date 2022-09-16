<?php

namespace Database\Factories\Modules\Stock\Brand\Repository;

use App\Modules\Stock\Brand\Repository\Eloquent\Model\BrandModelEloquent;
use App\Shared\Repository\Enum\DbRepositoryEnum;
use Database\Factories\Modules\Stock\Brand\Repository\Eloquent\BrandFactoryEloquent;

final class BrandFactoryProvider
{
    public static function make(DbRepositoryEnum $type = DbRepositoryEnum::NONE): BrandFactoryInterface
    {
        // Tipo de Repositório
        $dbRepository = DbRepositoryEnum::from(env('DB_REPOSITORY', 'eloquent'));
        if ($type !== DbRepositoryEnum::NONE) $dbRepository = $type;

        // Instanciar Factory
        return match ($dbRepository) {
            DbRepositoryEnum::ELOQUENT => new BrandFactoryEloquent(new BrandModelEloquent()),
            DbRepositoryEnum::OTHER    => null,
        };
    }
}