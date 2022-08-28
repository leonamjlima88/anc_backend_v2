<?php

namespace App\Modules\Stock\Brand\Resource;

use App\Modules\Stock\Brand\Domain\Entity\BrandEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandShowResource extends JsonResource
{
  public function __construct(?BrandEntity $resource)
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
