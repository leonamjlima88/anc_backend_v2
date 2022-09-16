<?php

namespace App\Modules\General\Person\Enum;

use App\Shared\Trait\EnumTrait;

enum PersonAddressTypeEnum: int
{
  use EnumTrait;
  
  case NOTAG = 0;
  case DELIVERY = 1;
  case BILLING = 2;
}