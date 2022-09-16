<?php

namespace App\Modules\General\Person\Repository\Eloquent\Model;

use App\Modules\General\City\Repository\Eloquent\Model\CityModelEloquent;
use App\Shared\Repository\Eloquent\BaseModelEloquent;
use App\Shared\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonModelEloquent extends BaseModelEloquent
{
  use HasFactory, UuidTrait;

  protected $table = 'person';
  protected $fillable = [
    'business_name',
    'alias_name',
    'ein',
    'icms_taxpayer',
    'state_registration',
    'municipal_registration',
    'zipcode',
    'address',
    'address_number',
    'complement',
    'district',
    'city_id',
    'reference_point',
    'phone_1',
    'phone_2',
    'phone_3',
    'company_email',
    'financial_email',
    'internet_page',
    'note',
    'bank_note',
    'commercial_note',
    'is_customer',
    'is_seller',
    'is_supplier',
    'is_carrier',
    'is_technician',
    'is_employee',
    'is_other',
    'is_final_customer',
    'created_by_user_id',
    'updated_by_user_id',
  ];
  
  protected $casts = [
    'icms_taxpayer' => 'boolean',
    'is_customer' => 'boolean',
    'is_seller' => 'boolean',
    'is_supplier' => 'boolean',
    'is_carrier' => 'boolean',
    'is_technician' => 'boolean',
    'is_employee' => 'boolean',
    'is_other' => 'boolean',
    'is_final_customer' => 'boolean',
  ];

  public function city()
  {
    return $this->hasOne(CityModelEloquent::class, 'id', 'city_id');
  }

  public function personAddress()
  {
    return $this->hasMany(PersonAddressModelEloquent::class, 'person_id', 'id');
  }

  public function personContact()
  {
    return $this->hasMany(PersonContactModelEloquent::class, 'person_id', 'id');
  }
}