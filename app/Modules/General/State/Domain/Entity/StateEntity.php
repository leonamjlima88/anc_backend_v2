<?php

namespace App\Modules\General\State\Domain\Entity;

use App\Shared\Entity\BaseEntity;

final class StateEntity extends BaseEntity
{
  public function __construct(
    public ?int    $id,
    public string  $name,
    public string  $abbreviation,
    public ?string $created_at,
    public ?string $updated_at,
  ){
    parent::__construct();
  }  
}