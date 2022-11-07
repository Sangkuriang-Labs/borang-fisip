<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'name' => 'admin1',
      'email' => 'admin1@example.com',
      'password' => 'password',
    ]);
    User::create([
      'name' => 'admin2',
      'email' => 'admin2@example.com',
      'password' => 'password',
    ]);
  }
}
