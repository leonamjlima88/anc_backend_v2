<?php

namespace Database\Factories\Modules\General\State\Repository\Eloquent\Model;

use App\Modules\General\State\Repository\Eloquent\Model\StateModelEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateModelEloquentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = StateModelEloquent::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $fakerBr = \Faker\Factory::create('pt_BR');
    return [
      'name' => $this->faker->name(),
      'abbreviation' => $fakerBr->stateAbbr,
    ];
  }
}
