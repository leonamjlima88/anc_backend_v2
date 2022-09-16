<?php

namespace App\Modules\Stock\Brand\Repository\Eloquent\Model;

use App\Modules\General\City\Repository\Eloquent\Model\CityModelEloquent;
use App\Shared\Repository\Eloquent\ModelEloquentBase;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandModelEloquent extends ModelEloquentBase
{
  use HasFactory, UuidTrait;

  protected $table = 'brand';
  protected $fillable = [
    'name',
    'created_by_user_id',
    'updated_by_user_id',
  ];
  
  protected $casts = [
  ];
}