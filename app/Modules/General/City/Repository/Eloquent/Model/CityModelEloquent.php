<?php

namespace App\Modules\General\City\Repository\Eloquent\Model;

use App\Modules\General\State\Repository\Eloquent\Model\StateModelEloquent;
use App\Shared\Repository\Eloquent\BaseModelEloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CityModelEloquent extends BaseModelEloquent
{
  use HasFactory;

  protected $table = 'city';
  protected $fillable = [
    'name',
    'ibge_code',
    'state_id',
  ];
  
  protected $casts = [    
  ];

  public function state()
  {
    return $this->hasOne(StateModelEloquent::class, 'id', 'state_id');
  }
}
