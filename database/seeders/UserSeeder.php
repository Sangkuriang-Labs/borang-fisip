<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Position;
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
    $positionId = Position::where('name', 'Admin')->first();
    User::factory()->create(['position_id' => $positionId->id]);
    User::factory()->create(['major_id' => Major::first()->id, 'position_id' => Position::where('name', 'Dosen')->first()->id, 'name' => 'Alif Nuryana', 'email' => 'alif@widyatama.ac.id']);
  }
}
