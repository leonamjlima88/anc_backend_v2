<?php

namespace App\Modules\General\Person\Domain\Service;

use App\Modules\General\Person\Domain\Entity\PersonEntity;
use App\Modules\General\Person\Repository\PersonRepositoryInterface;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Service\ServiceBase;

final class PersonService extends ServiceBase
{
    private function __construct(private PersonRepositoryInterface $repository){}

    public static function make(PersonRepositoryInterface $repository): self {
        return new self($repository);
    }

    public function destroy(string $id): bool {
        return $this->repository->destroy($id);
    }

    public function index(): array {
        return $this->repository->index();
    }

    public function show(string $id): ?PersonEntity {
        return $this->repository->show($id);
    }

    public function store(PersonEntity $entity): PersonEntity {
        PersonBeforeSaveService::make()->execute($entity);

        return $this->repository->store($entity);
    }

    public function update(PersonEntity $entity, string $id): PersonEntity {
        PersonBeforeSaveService::make()->execute($entity);
        
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
