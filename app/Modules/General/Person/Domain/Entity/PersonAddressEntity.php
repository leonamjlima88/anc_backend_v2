<?php

namespace App\Modules\General\Person\Domain\Entity;

use App\Modules\General\City\Domain\Entity\CityEntity;
use App\Modules\General\Person\Enum\PersonAddressTypeEnum;

final class PersonAddressEntity
{
  public function __construct(
    public ?string $id,
    public ?string $person_id,
    public PersonAddressTypeEnum|int|null $type,
    public ?string $zipcode,
    public string $address,
    public ?string $address_number,
    public ?string $complement,
    public ?string $district,
    public ?string $reference_point,
    public int $city_id,    
    public ?CityEntity $city,
  ){}  
}