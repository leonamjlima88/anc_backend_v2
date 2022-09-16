<?php 

namespace App\Shared\Repository\Enum;

use App\Shared\Trait\EnumTrait;

enum DbRepositoryEnum: string
{
  use EnumTrait;
  
  case NONE = '';
  case ELOQUENT = 'eloquent';
  case OTHER = 'other';  
}