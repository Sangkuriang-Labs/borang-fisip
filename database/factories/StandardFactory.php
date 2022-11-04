<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Standard>
 */
class StandardFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */

  private static $order = 1;

  public function definition()
  {
    return [
      'number' => strval(self::$order++),
      'name' => fake()->sentence(3),
    ];
  }
}
