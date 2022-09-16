<?php

namespace App\Modules\Stock\Category\Repository\Eloquent\Model;

use App\Shared\Repository\Eloquent\BaseModelEloquent;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryModelEloquent extends BaseModelEloquent
{
  use HasFactory, UuidTrait;

  protected $table = 'category';
  protected $fillable = [
    'name',
    'created_by_user_id',
    'updated_by_user_id',
  ];
  
  protected $casts = [
  ];
}