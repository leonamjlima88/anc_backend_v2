<?php

namespace Database\Factories\Modules\Stock\Unit\Repository\Eloquent\Model;

use App\Modules\Stock\Unit\Repository\Eloquent\Model\UnitModelEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitModelEloquentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = UnitModelEloquent::class;

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
