<?php

namespace App\Shared\Dto\PageFilter\Enum;

use App\Shared\Trait\EnumTrait;

enum OperatorEnum: string
{
  use EnumTrait;
  
  case EQUAL = 'equal';
  case GREATER = 'greater';
  case LESS = 'less';
  case GREATER_OR_EQUAL = 'greaterOrEqual';
  case LESS_OR_EQUAL = 'lessOrEqual';
  case DIFFERENT = 'different';
  case LIKE_INITIAL = 'likeInitial';
  case LIKE_FINAL = 'likeFinal';
  case LIKE_ANYWHERE = 'likeAnywhere';
  case LIKE_EQUAL = 'likeEqual';
}