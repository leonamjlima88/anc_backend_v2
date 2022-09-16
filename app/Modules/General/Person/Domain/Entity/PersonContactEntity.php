<?php

namespace App\Modules\General\Person\Domain\Entity;

final class PersonContactEntity
{
  public function __construct(
    public ?int $id,
    public ?int $person_id,
    public ?string $name,
    public ?string $ein,
    public ?string $type,
    public ?string $note,
    public ?string $phone,
    public ?string $email,
  ){}
}