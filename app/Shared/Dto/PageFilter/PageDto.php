<?php

namespace App\Shared\Dto\PageFilter;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class PageDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|boolean')]
    public ?bool $isPaginate,

    #[Rule('nullable|integer')]
    public ?int $limit,    

    #[Rule('nullable|integer')]
    public ?int $current,

    #[Rule('nullable|array')]
    public ?array $columns,
  ) {
  }

  /**
   * Utilizado para extrair dados formatados se necessário
   *
   * @return array
   */
  public function toResource(): array
  {
    return parent::toArray();
  }  
}