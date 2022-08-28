<?php

namespace Database\Factories\Modules\Stock\Product\Adapter\Repository\Eloquent;

use App\Modules\Stock\Product\Adapter\Repository\Eloquent\ProductModelEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductModelEloquentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = ProductModelEloquent::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->name(),
      'description' => $this->faker->text(255),
      'sku' => $this->faker->unique()->text(36),
      'price' => $this->faker->numberBetween(1,1000),
    ];
  }
}
