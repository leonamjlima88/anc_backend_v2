<?php

namespace App\Modules\General\State\Repository\Eloquent\Model;

use App\Shared\Repository\Eloquent\BaseModelEloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StateModelEloquent extends BaseModelEloquent
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
