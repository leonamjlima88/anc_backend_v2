<?php

namespace App\Modules\General\Example\Repository\Eloquent\Model;

use App\Shared\Repository\Eloquent\ModelEloquentBase;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExampleModelEloquent extends ModelEloquentBase
{
  use HasFactory, UuidTrait;

  protected $table = 'example';
  protected $fillable = [
    'name',
    'created_by_user_id',
    'updated_by_user_id',
  ];
  
  protected $casts = [
  ];
}