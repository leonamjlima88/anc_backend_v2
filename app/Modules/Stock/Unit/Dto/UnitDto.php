<?php

namespace App\Modules\Stock\Unit\Dto;

use App\Modules\Stock\Unit\Domain\Entity\UnitEntity;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class UnitDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|string|max:36')]
    public ?string    $id,

    #[Rule('required|string|max:10')]
    public string  $abbreviation,

    #[Rule('nullable|string|max:100')]
    public ?string  $description,

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

  public function toEntity(): ?UnitEntity
  {
    $data = instanceToArray($this);
    return new UnitEntity(...$data);
  }  
}
