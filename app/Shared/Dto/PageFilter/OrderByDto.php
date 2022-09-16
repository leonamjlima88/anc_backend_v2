<?php

namespace App\Shared\Dto\PageFilter;

use App\Shared\Dto\PageFilter\Enum\DirectionEnum;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class OrderByDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('required|string')]
    public string $fieldName,

    public string $direction,
  ) {
  }

  // Regras de validação
  public static function rules(): array
  {
    return [
      'direction' => [
        'required',
        new Enum(DirectionEnum::class)
      ],
    ];
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
