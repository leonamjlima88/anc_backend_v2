<?php

namespace App\Shared\Entity\PageFilter;

use App\Shared\Dto\PageFilter\Enum\DirectionEnum;

final class OrderByEntity
{
  public function __construct(
    public string $fieldName,
    public DirectionEnum $direction,
  ) {
  }
}
