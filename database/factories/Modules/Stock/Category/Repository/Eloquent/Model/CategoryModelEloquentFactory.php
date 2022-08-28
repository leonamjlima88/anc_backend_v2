<?php

namespace Database\Factories\Modules\Stock\Category\Repository\Eloquent\Model;

use App\Modules\Stock\Category\Repository\Eloquent\Model\CategoryModelEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryModelEloquentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = CategoryModelEloquent::class;

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
