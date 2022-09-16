<?php

namespace App\Modules\Stock\StorageLocation\Resource;

use App\Modules\Stock\StorageLocation\Domain\Entity\StorageLocationEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class StorageLocationShowResource extends JsonResource
{
  public function __construct(?StorageLocationEntity $resource)
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
