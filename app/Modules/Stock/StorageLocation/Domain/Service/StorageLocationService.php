<?php

namespace App\Modules\Stock\StorageLocation\Domain\Service;

use App\Modules\Stock\StorageLocation\Domain\Entity\StorageLocationEntity;
use App\Modules\Stock\StorageLocation\Repository\StorageLocationRepositoryInterface;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Service\ServiceBase;

final class StorageLocationService extends ServiceBase
{
    private function __construct(private StorageLocationRepositoryInterface $repository){}

    public static function make(StorageLocationRepositoryInterface $repository): self {
        return new self($repository);
    }

    public function destroy(string $id): bool {
        return $this->repository->destroy($id);
    }

    public function index(): array {
        return $this->repository->index();
    }

    public function show(string $id): ?StorageLocationEntity {
        return $this->repository->show($id);
    }

    public function store(StorageLocationEntity $entity): StorageLocationEntity {
        $idStored = $this->repository->store($entity);
        return $this->show($idStored);
    }

    public function update(StorageLocationEntity $entity, string $id): StorageLocationEntity {
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
