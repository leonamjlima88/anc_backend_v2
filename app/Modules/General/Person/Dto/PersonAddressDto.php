<?php

namespace App\Modules\General\Person\Dto;

use App\Modules\General\Person\Enum\PersonAddressTypeEnum;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class PersonAddressDto extends Data
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

    // Validação abaixo em rules()
    public PersonAddressTypeEnum|int|null $type,

    #[Rule('nullable|string|max:10')]
    public ?string $zipcode,

    #[Rule('required|string|max:100')]
    public string $address,

    #[Rule('nullable|string|max:15')]
    public ?string $address_number,

    #[Rule('nullable|string|max:100')]
    public ?string $complement,

    #[Rule('nullable|string|max:100')]
    public ?string $district,

    #[Rule('nullable|string|max:100')]
    public ?string $reference_point,

    #[Rule('required|integer')]
    public int $city_id,

    #[Rule('nullable')]
    public object|array|null $city,
  ) {
  }

  public static function rules(): array
  {
    return [
      'type' => [
        'nullable',
        new Enum(PersonAddressTypeEnum::class)
      ],
    ];
  }
}
