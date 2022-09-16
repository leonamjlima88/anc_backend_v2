<?php

namespace App\Modules\Stock\Unit\Repository\Eloquent\Model;

use App\Shared\Repository\Eloquent\BaseModelEloquent;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitModelEloquent extends BaseModelEloquent
{
  use HasFactory, UuidTrait;

  protected $table = 'unit';
  protected $fillable = [
    'abbreviation',
    'description',
    'created_by_user_id',
    'updated_by_user_id',
  ];
  
  protected $casts = [
  ];
}