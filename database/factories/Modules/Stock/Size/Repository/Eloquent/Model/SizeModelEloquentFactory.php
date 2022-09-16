<?php

namespace Database\Factories\Modules\Stock\Size\Repository\Eloquent\Model;

use App\Modules\Stock\Size\Repository\Eloquent\Model\SizeModelEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

class SizeModelEloquentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = SizeModelEloquent::class;

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
