<?php

namespace App\Modules\General\Example\Domain\Service;

use App\Modules\General\Example\Domain\Entity\ExampleEntity;
use App\Modules\General\Example\Repository\ExampleRepositoryInterface;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Service\ServiceBase;

final class ExampleService extends ServiceBase
{
    private function __construct(private ExampleRepositoryInterface $repository){}

    public static function make(ExampleRepositoryInterface $repository): self {
        return new self($repository);
    }

    public function destroy(string $id): bool {
        return $this->repository->destroy($id);
    }

    public function index(): array {
        return $this->repository->index();
    }

    public function show(string $id): ?ExampleEntity {
        return $this->repository->show($id);
    }

    public function store(ExampleEntity $entity): ExampleEntity {
        return $this->repository->store($entity);
    }

    public function update(ExampleEntity $entity, string $id): ExampleEntity {
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
