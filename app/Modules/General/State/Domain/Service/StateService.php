<?php

namespace App\Modules\General\State\Domain\Service;

use App\Modules\General\State\Domain\Entity\StateEntity;
use App\Modules\General\State\Repository\StateRepositoryInterface;
use App\Shared\Entity\PageFilter\PageFilterEntity;
use App\Shared\Service\ServiceBase;

final class StateService extends ServiceBase
{
    private function __construct(private StateRepositoryInterface $repository){}

    public static function make(StateRepositoryInterface $repository): self {
        return new self($repository);
    }

    public function index(): array {
        return $this->repository->index();
    }

    public function show(int $id): ?StateEntity {
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
