<?php

namespace Database\Factories\Modules\General\Person\Repository\Eloquent\Model;

use App\Modules\General\City\Repository\Eloquent\Model\CityModelEloquent;
use App\Modules\General\Person\Repository\Eloquent\Model\PersonModelEloquent;
use App\Modules\General\State\Repository\Eloquent\Model\StateModelEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonModelEloquentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = PersonModelEloquent::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $fakerBr = \Faker\Factory::create('pt_BR');
    $name = $fakerBr->name;
    return [
      'business_name' => $name,
      'alias_name' => $name,
      'ein' => onlyNumbers(strval($fakerBr->cpf)),
      'address' => $fakerBr->address,
      'address_number' => strval($this->faker->randomDigit()),
      'district' => $this->faker->text(60),
      'city_id' => CityModelEloquent::factory()->create(),
      'is_customer' => true,
      'is_final_customer' => true,
      'phone_1' => sprintf('(0%s) %s', $fakerBr->areaCode, $fakerBr->landline),
      'company_email' => $this->faker->email(),
    ];
  }
}
