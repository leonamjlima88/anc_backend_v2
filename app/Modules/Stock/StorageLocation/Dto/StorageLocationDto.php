<?php

namespace App\Modules\Stock\StorageLocation\Dto;

use App\Modules\Stock\StorageLocation\Domain\Entity\StorageLocationEntity;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class StorageLocationDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|string|max:36')]
    public ?string    $id,

    #[Rule('required|string|max:100')]
    public string  $name,

    #[Rule('nullable|string|min:10')]
    public ?string $created_at,

    #[Rule('nullable|string|min:10')]
    public ?string $updated_at,

    #[Rule('nullable|integer')]
    public ?int    $created_by_user_id,

    #[Rule('nullable|integer')]
    public ?int    $updated_by_user_id,
  ) {
  }

  public function toEntity(): ?StorageLocationEntity
  {
    $data = instanceToArray($this);
    return new StorageLocationEntity(...$data);
  }  
}
