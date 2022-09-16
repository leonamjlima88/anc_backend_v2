<?php

namespace App\Shared\Repository;

interface BaseFactoryInterface
{
    public function generate(array $attributes = []): array;
    public function create(int $count = 1, array $attributes = []): array;
}
