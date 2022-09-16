<?php

namespace App\Modules\Stock\StorageLocation\Repository\Eloquent\Model;

use App\Shared\Repository\Eloquent\ModelEloquentBase;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StorageLocationModelEloquent extends ModelEloquentBase
{
  use HasFactory, UuidTrait;

  protected $table = 'storage_location';
  protected $fillable = [
    'name',
    'created_by_user_id',
    'updated_by_user_id',
  ];
  
  protected $casts = [
  ];
}