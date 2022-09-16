<?php

namespace App\Modules\General\Person\Dto;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class PersonContactDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|string|max:36')]
    public ?string $id,

    #[Rule('nullable|string|max:36')]
    public ?string $person_id,

    #[Rule('nullable|string|max:60')]
    public ?string $name,

    public ?string $ein,

    #[Rule('nullable|string|max:100')]
    public ?string $type,

    #[Rule('nullable|string')]
    public ?string $note,

    #[Rule('nullable|string|max:30')]
    public ?string $phone,

    #[Rule('nullable|string|email|max:100')]
    public ?string $email,
  ) {
  }

  public static function rules(): array
  {
    return [
      'ein' => [
        'nullable',
        'string',
        'numeric',
        fn ($att, $value, $fail) => static::rulesEin($att, $value, $fail),
      ],
    ];
  }

  // Validar CPF/CNPJ
  public static function rulesEin($att, $value, $fail){
    if ($value && (!cpfOrCnpjIsValid($value))) {
      $fail(trans('request_validation_lang.field_is_not_valid', ['value' => $value]));
    }  
  }
}
