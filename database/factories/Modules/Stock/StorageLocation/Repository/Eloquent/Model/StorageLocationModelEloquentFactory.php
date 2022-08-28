<?php

namespace Database\Factories\Modules\Stock\StorageLocation\Repository\Eloquent\Model;

use App\Modules\Stock\StorageLocation\Repository\Eloquent\Model\StorageLocationModelEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorageLocationModelEloquentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = StorageLocationModelEloquent::class;

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
