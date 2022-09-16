<?php

namespace App\Shared\Entity;

class BaseEntity
{
  public function __construct(){
    // ...
  }

  public function toArray()
  {
    return instanceToArray($this);
  }

  public static function fromArray(array $data)
  {
    return new static(...$data);
  }
}