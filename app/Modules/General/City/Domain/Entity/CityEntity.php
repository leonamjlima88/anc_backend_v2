<?php

namespace App\Modules\General\City\Domain\Entity;

use App\Modules\General\State\Domain\Entity\StateEntity;
use App\Shared\Entity\BaseEntity as EntityBaseEntity;

final class CityEntity extends EntityBaseEntity
{
  public function __construct(
    public ?int    $id,
    public string  $name,
    public string  $ibge_code,
    public int     $state_id,
    public ?string $created_at,
    public ?string $updated_at,
    public ?StateEntity $state,
  ){
    parent::__construct();
  }  
}