<?php

namespace App\Modules\General\Person\Dto;

use App\Modules\General\Person\Domain\Entity\PersonAddressEntity;
use App\Modules\General\Person\Domain\Entity\PersonContactEntity;
use App\Modules\General\Person\Domain\Entity\PersonEntity;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PersonDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|string|max:36')]
    public ?string    $id,

    #[Rule('required|string|max:100')]
    public string  $business_name,

    #[Rule('required|string|max:100')]
    public string  $alias_name,

    // Validação abaixo em rules()
    public string  $ein,

    #[Rule('nullable|boolean')]
    public ?bool   $icms_taxpayer,
    
    #[Rule('nullable|string|max:20')]
    public ?string $state_registration,

    #[Rule('nullable|string|max:20')]
    public ?string $municipal_registration,

    #[Rule('nullable|string|max:10')]
    public ?string $zipcode,

    #[Rule('required|string|max:100')]
    public string  $address,

    #[Rule('nullable|string|max:15')]
    public ?string $address_number,

    #[Rule('nullable|string|max:100')]
    public ?string $complement,

    #[Rule('required|string|max:100')]
    public string  $district,

    #[Rule('required|integer')]
    public int     $city_id,

    #[Rule('nullable|string|max:100')]
    public ?string $reference_point,

    #[Rule('nullable|string|max:40')]
    public ?string $phone_1,

    #[Rule('nullable|string|max:40')]
    public ?string $phone_2,

    #[Rule('nullable|string|max:40')]
    public ?string $phone_3,

    #[Rule('nullable|string|max:100|email')]
    public ?string $company_email,

    #[Rule('nullable|string|max:100|email')]
    public ?string $financial_email,

    #[Rule('nullable|string|max:255')]
    public ?string $internet_page,

    #[Rule('nullable|string')]
    public ?string $note,

    #[Rule('nullable|string')]
    public ?string $bank_note,

    #[Rule('nullable|string')]
    public ?string $commercial_note,

    #[Rule('nullable|boolean')]
    public ?bool    $is_customer,

    #[Rule('nullable|boolean')]
    public ?bool    $is_seller,

    #[Rule('nullable|boolean')]
    public ?bool    $is_supplier,

    #[Rule('nullable|boolean')]
    public ?bool    $is_carrier,

    #[Rule('nullable|boolean')]
    public ?bool    $is_technician,

    #[Rule('nullable|boolean')]
    public ?bool    $is_employee,

    #[Rule('nullable|boolean')]
    public ?bool    $is_other,

    #[Rule('required|boolean')]
    public bool     $is_final_customer,

    #[Rule('nullable|string|min:10')]
    public ?string $created_at,

    #[Rule('nullable|string|min:10')]
    public ?string $updated_at,

    #[Rule('nullable|integer')]
    public ?int    $created_by_user_id,

    #[Rule('nullable|integer')]
    public ?int    $updated_by_user_id,

    #[Rule('nullable')]
    public object|array|null $city,

    /** @var PersonAddressDto[] */
    public ?DataCollection $person_address,

    /** @var PersonContactDto[] */
    public ?DataCollection $person_contact,
  ) {
  }

  public static function rules(): array
  {
    return [
      'ein' => [
        'required',
        'string',
        'numeric',
         ValidationRule::unique('person', 'ein')->ignore(getRouteParameter()),
        fn ($att, $value, $fail) => static::rulesEin($att, $value, $fail),
      ],
    ];
  }

  // Validar CPF/CNPJ
  public static function rulesEin($att, $value, $fail)
  {
    if ($value && (!cpfOrCnpjIsValid($value))) {
      $fail(trans('request_validation_lang.field_is_not_valid', ['value' => $value]));
    }
  }

  public static function withValidator(Validator $validator): void
  {
    $validator->after(function ($validator) {
      // Person - Tipo de Pessoa é obrigatório
      if ((!request('is_customer', ''))
      &&  (!request('is_seller', ''))
      &&  (!request('is_supplier', ''))
      &&  (!request('is_carrier', ''))
      &&  (!request('is_technician', ''))
      &&  (!request('is_employee', ''))
      &&  (!request('is_other', ''))
      ) {
        $validator->errors()->add('is_customer|is_seller|is_supplier|...', trans('request_validation_lang.at_least_one_field_must_be_filled'));
      }

      // PersonContact
      $contacts = request()->get('person_contact') ?? [];
      foreach ($contacts as $key => $value) {
        $fieldName = 'person_contact.' . $key . '.';

        // Documento ou Telefone ou Email precisa estar preenchido
        if ((!($value['name'] ?? ''))
        &&  (!($value['phone'] ?? ''))
        &&  (!($value['email'] ?? ''))
        ){
          $validator->errors()->add($fieldName . 'name|phone|email', trans('request_validation_lang.at_least_one_field_must_be_filled'));
        }
      }              
    });
  }

  public function toEntity(): ?PersonEntity
  {
    $data = instanceToArray($this);    
    $data['person_address'] = array_map(fn ($item) => new PersonAddressEntity(...$item), $data['person_address'] ?? []);
    $data['person_contact'] = array_map(fn ($item) => new PersonContactEntity(...$item), $data['person_contact'] ?? []);
    
    return new PersonEntity(...$data);
  }  
}
