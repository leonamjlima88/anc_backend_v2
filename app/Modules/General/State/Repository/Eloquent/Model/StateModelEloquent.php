<?php

namespace App\Modules\General\State\Repository\Eloquent\Model;

use App\Shared\Repository\Eloquent\ModelEloquentBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StateModelEloquent extends ModelEloquentBase
{
  use HasFactory;

  protected $table = 'state';
  protected $fillable = [
    'name',
    'abbreviation',
  ];
  
  protected $casts = [    
  ];
}
