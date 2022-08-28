<?php

namespace App\Shared\Entity\PageFilter;

use App\Shared\Dto\PageFilter\Enum\OperatorEnum;

final class WhereEntity
{
  public function __construct(
    public string $fieldName,
    public OperatorEnum $operator,
    public array $fieldValue,    
  ) {
  }
}
