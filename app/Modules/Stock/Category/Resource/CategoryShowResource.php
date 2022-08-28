<?php

namespace App\Modules\Stock\Category\Resource;

use App\Modules\Stock\Category\Domain\Entity\CategoryEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryShowResource extends JsonResource
{
  public function __construct(?CategoryEntity $resource)
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
