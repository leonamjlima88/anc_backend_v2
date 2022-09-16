<?php

namespace App\Modules\Stock\Size\Domain\Service;

use App\Modules\Stock\Size\Domain\Entity\SizeEntity;
use App\Modules\Stock\Size\Repository\SizeRepositoryInterface;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Service\ServiceBase;

final class SizeService extends ServiceBase
{
    private function __construct(private SizeRepositoryInterface $repository){}

    public static function make(SizeRepositoryInterface $repository): self {
        return new self($repository);
    }

    public function destroy(string $id): bool {
        return $this->repository->destroy($id);
    }

    public function index(): array {
        return $this->repository->index();
    }

    public function show(string $id): ?SizeEntity {
        return $this->repository->show($id);
    }

    public function store(SizeEntity $entity): SizeEntity {
        $idStored = $this->repository->store($entity);
        return $this->show($idStored);
    }

    public function update(SizeEntity $entity, string $id): SizeEntity {
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
