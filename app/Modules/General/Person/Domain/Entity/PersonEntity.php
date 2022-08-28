<?php

namespace App\Modules\General\Person\Domain\Entity;

use App\Modules\General\City\Domain\Entity\CityEntity;
use App\Shared\Entity\BaseEntity;

final class PersonEntity extends BaseEntity
{
  public function __construct(
    public ?string $id,
    public string $business_name,
    public string $alias_name,
    public string $ein,
    public ?bool $icms_taxpayer,
    public ?string $state_registration,
    public ?string $municipal_registration,
    public ?string $zipcode,
    public string $address,
    public ?string $address_number,
    public ?string $complement,
    public string $district,
    public int $city_id,
    public ?string $reference_point,
    public ?string $phone_1,
    public ?string $phone_2,
    public ?string $phone_3,
    public ?string $company_email,
    public ?string $financial_email,
    public ?string $internet_page,
    public ?string $note,
    public ?string $bank_note,
    public ?string $commercial_note,
    public ?bool $is_customer,
    public ?bool $is_seller,
    public ?bool $is_supplier,
    public ?bool $is_carrier,
    public ?bool $is_technician,
    public ?bool $is_employee,
    public ?bool $is_other,
    public bool $is_final_customer,
    public ?string $created_at,
    public ?string $updated_at,
    public ?int $created_by_user_id,
    public ?int $updated_by_user_id,
    public ?CityEntity $city,

    /** @var PersonAddressEntity[] */
    public ?array $person_address,

    /** @var PersonContactEntity[] */
    public ?array $person_contact,
  ){
    parent::__construct();
  }  
}