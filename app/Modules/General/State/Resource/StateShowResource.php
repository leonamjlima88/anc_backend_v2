<?php

namespace App\Modules\General\State\Resource;

use App\Modules\General\State\Domain\Entity\StateEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class StateShowResource extends JsonResource
{
  public function __construct(?StateEntity $resource)
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
