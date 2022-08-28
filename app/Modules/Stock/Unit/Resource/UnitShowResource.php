<?php

namespace App\Modules\Stock\Unit\Resource;

use App\Modules\Stock\Unit\Domain\Entity\UnitEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitShowResource extends JsonResource
{
  public function __construct(?UnitEntity $resource)
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
