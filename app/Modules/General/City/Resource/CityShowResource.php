<?php

namespace App\Modules\General\City\Resource;

use App\Modules\General\City\Domain\Entity\CityEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class CityShowResource extends JsonResource
{
  public function __construct(?CityEntity $resource)
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
