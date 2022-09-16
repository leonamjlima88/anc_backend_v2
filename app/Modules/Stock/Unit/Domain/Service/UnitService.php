<?php

namespace App\Modules\Stock\Unit\Domain\Service;

use App\Modules\Stock\Unit\Domain\Entity\UnitEntity;
use App\Modules\Stock\Unit\Repository\UnitRepositoryInterface;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Service\ServiceBase;

final class UnitService extends ServiceBase
{
    private function __construct(private UnitRepositoryInterface $repository){}

    public static function make(UnitRepositoryInterface $repository): self {
        return new self($repository);
    }

    public function destroy(string $id): bool {
        return $this->repository->destroy($id);
    }

    public function index(): array {
        return $this->repository->index();
    }

    public function show(string $id): ?UnitEntity {
        return $this->repository->show($id);
    }

    public function store(UnitEntity $entity): UnitEntity {
        $idStored = $this->repository->store($entity);
        return $this->show($idStored);
    }

    public function update(UnitEntity $entity, string $id): UnitEntity {
        $this->repository->update($entity, $id);
        return $this->show($id);
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
