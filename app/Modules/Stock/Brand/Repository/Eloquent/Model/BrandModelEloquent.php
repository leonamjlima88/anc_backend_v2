<?php

namespace App\Modules\Stock\Brand\Repository\Eloquent\Model;

use App\Shared\Repository\Eloquent\BaseModelEloquent;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandModelEloquent extends BaseModelEloquent
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