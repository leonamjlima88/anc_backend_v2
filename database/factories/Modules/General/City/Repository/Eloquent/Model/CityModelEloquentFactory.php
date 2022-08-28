<?php

namespace Database\Factories\Modules\General\City\Repository\Eloquent\Model;

use App\Modules\General\City\Repository\Eloquent\Model\CityModelEloquent;
use App\Modules\General\State\Repository\Eloquent\Model\StateModelEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityModelEloquentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = CityModelEloquent::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $fakerBr = \Faker\Factory::create('pt_BR');
    return [
      'name' => $fakerBr->city,
      'ibge_code' => $this->faker->randomDigit(),
      'state_id' => StateModelEloquent::factory()->create(),
    ];
  }
}
