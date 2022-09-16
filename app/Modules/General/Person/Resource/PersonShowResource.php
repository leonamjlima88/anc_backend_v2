<?php

namespace App\Modules\General\Person\Resource;

use App\Modules\General\Person\Domain\Entity\PersonEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonShowResource extends JsonResource
{
  public function __construct(?PersonEntity $resource)
  {
    parent::__construct($resource);
  }

  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   *
   * @return array
   */
  public function toArray($request)
  {
    return $this->resource;
  }
}
