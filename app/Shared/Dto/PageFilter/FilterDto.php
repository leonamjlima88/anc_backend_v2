<?php

namespace App\Shared\Dto\PageFilter;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class FilterDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|array')]
    /** @var OrderByDto[] */
    public ?DataCollection $orderBy,

    #[Rule('nullable|array')]
    /** @var WhereDto[] */
    public ?DataCollection $where,

    #[Rule('nullable|array')]
    /** @var OrWhereDto[] */
    public ?DataCollection $orWhere,
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
