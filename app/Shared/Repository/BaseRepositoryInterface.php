<?php

namespace App\Shared\Repository;

use App\Shared\Entity\BaseEntity;
use App\Shared\Entity\PageFilter\PageFilterEntity;

interface BaseRepositoryInterface
{
    public function index(): array;
    public function store(BaseEntity $entity): string|int;
    public function show(string|int $id): ?BaseEntity;
    public function update(BaseEntity $entity, string|int $id): bool;    
    public function destroy(string|int $id): bool;    
    public function query(PageFilterEntity $pageFilterEntity): array;
    public function setTransaction(bool $value): self;
}
