<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Content::create([
      'sub_id' => Sub::all()->first()->id,
      'user_id' => User::all()->first()->id,
      'content' => fake()->sentence(1),
      'description' => fake()->sentence(10)
    ]);
  }
}
