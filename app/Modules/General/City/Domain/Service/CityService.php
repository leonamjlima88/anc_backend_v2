<?php

namespace App\Modules\General\City\Domain\Service;

use App\Modules\General\City\Domain\Entity\CityEntity;
use App\Modules\General\City\Repository\CityRepositoryInterface;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Service\ServiceBase;

final class CityService extends ServiceBase
{
    private function __construct(private CityRepositoryInterface $repository){}

    public static function make(CityRepositoryInterface $repository): self {
        return new self($repository);
    }

    public function index(): array {
        return $this->repository->index();
    }

    public function show(int $id): ?CityEntity {
        return $this->repository->show($id);
    }

    /**
     * Filtragem dos dados
     *
     * @param PageFilterEntity $pageFilterEntity
     * @return array
     */
    public function query(PageFilterEntity $pageFilterEntity): array {
        return $this->repository->query($pageFilterEntity);
    }
}
