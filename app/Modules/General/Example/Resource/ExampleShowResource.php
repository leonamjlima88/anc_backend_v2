<?php

namespace App\Modules\General\Example\Resource;

use App\Modules\General\Example\Domain\Entity\ExampleEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class ExampleShowResource extends JsonResource
{
  public function __construct(?ExampleEntity $resource)
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
