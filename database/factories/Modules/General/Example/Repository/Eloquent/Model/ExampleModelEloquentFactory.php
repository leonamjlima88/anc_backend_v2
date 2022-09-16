<?php

namespace Database\Factories\Modules\General\Example\Repository\Eloquent\Model;

use App\Modules\General\Example\Repository\Eloquent\Model\ExampleModelEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExampleModelEloquentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = ExampleModelEloquent::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->name(),
    ];
  }
}
