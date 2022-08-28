<?php

namespace App\Modules\Stock\Size\Resource;

use App\Modules\Stock\Size\Domain\Entity\SizeEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class SizeShowResource extends JsonResource
{
  public function __construct(?SizeEntity $resource)
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
