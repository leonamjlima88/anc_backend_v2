<?php

namespace App\Shared\Dto\PageFilter\Enum;

use App\Shared\Trait\EnumTrait;

enum DirectionEnum: string
{
  use EnumTrait;
  
  case NONE = '';
  case ASC = 'asc';
  case DESC = 'desc';
}