<?php

namespace App\Modules\Stock\Unit\Domain\Entity;

use App\Shared\Entity\BaseEntity;

final class UnitEntity extends BaseEntity
{
  public function __construct(
    public ?string $id,
    public string $abbreviation,
    public ?string $description,
    public ?string $created_at,
    public ?string $updated_at,
    public ?int $created_by_user_id,
    public ?int $updated_by_user_id,
  ){
    parent::__construct();
  }  
}