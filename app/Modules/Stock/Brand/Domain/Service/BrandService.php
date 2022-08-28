<?php

namespace App\Modules\Stock\Brand\Domain\Service;

use App\Modules\Stock\Brand\Domain\Entity\BrandEntity;
use App\Modules\Stock\Brand\Repository\BrandRepositoryInterface;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Service\ServiceBase;

final class BrandService extends ServiceBase
{
    private function __construct(private BrandRepositoryInterface $repository){}

    public static function make(BrandRepositoryInterface $repository): self {
        return new self($repository);
    }

    public function destroy(string $id): bool {
        return $this->repository->destroy($id);
    }

    public function index(): array {
        return $this->repository->index();
    }

    public function show(string $id): ?BrandEntity {
        return $this->repository->show($id);
    }

    public function store(BrandEntity $entity): BrandEntity {
        return $this->repository->store($entity);
    }

    public function update(BrandEntity $entity, string $id): BrandEntity {
        return $this->repository->update($entity, $id);
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
