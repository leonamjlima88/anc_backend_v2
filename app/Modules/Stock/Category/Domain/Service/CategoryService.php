<?php

namespace App\Modules\Stock\Category\Domain\Service;

use App\Modules\Stock\Category\Domain\Entity\CategoryEntity;
use App\Modules\Stock\Category\Repository\CategoryRepositoryInterface;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Service\ServiceBase;

final class CategoryService extends ServiceBase
{
    private function __construct(private CategoryRepositoryInterface $repository){}

    public static function make(CategoryRepositoryInterface $repository): self {
        return new self($repository);
    }

    public function destroy(string $id): bool {
        return $this->repository->destroy($id);
    }

    public function index(): array {
        return $this->repository->index();
    }

    public function show(string $id): ?CategoryEntity {
        return $this->repository->show($id);
    }

    public function store(CategoryEntity $entity): CategoryEntity {
        return $this->repository->store($entity);
    }

    public function update(CategoryEntity $entity, string $id): CategoryEntity {
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
