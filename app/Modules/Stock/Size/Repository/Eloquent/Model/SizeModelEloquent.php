<?php

namespace App\Modules\Stock\Size\Repository\Eloquent\Model;

use App\Shared\Repository\Eloquent\ModelEloquentBase;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SizeModelEloquent extends ModelEloquentBase
{
  use HasFactory, UuidTrait;

  protected $table = 'size';
  protected $fillable = [
    'name',
    'created_by_user_id',
    'updated_by_user_id',
  ];
  
  protected $casts = [
  ];
}