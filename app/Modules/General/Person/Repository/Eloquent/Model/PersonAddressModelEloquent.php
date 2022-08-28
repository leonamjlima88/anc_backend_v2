<?php

namespace App\Modules\General\Person\Repository\Eloquent\Model;

use App\Modules\General\City\Repository\Eloquent\Model\CityModelEloquent;
use App\Modules\General\Person\Enum\PersonAddressTypeEnum;
use App\Shared\Repository\Eloquent\ModelEloquentBase;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonAddressModelEloquent extends ModelEloquentBase
{
  use HasFactory, UuidTrait;

  protected $table = 'person_address';
  protected $fillable = [
    'person_id',
    'type',
    'zipcode',
    'address',
    'address_number',
    'complement',
    'district',
    'city_id',
    'reference_point',
  ];
  
  protected $casts = [
    'type' => PersonAddressTypeEnum::class,  
  ];
  
  public $timestamps = false;

  public function city()
  {
    return $this->hasOne(CityModelEloquent::class, 'id', 'city_id');
  }
}
