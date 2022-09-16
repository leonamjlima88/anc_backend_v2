<?php

namespace App\Modules\General\City\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class CityQueryResource extends JsonResource
{
  public function __construct(array $resource)
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
