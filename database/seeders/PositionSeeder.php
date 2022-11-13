<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
  public function run()
  {
    Position::create(['name' => 'Admin']);
    Position::create(['name' => 'Dekan']);
    Position::create(['name' => 'Ketua Program Studi']);
    Position::create(['name' => 'Dosen']);
  }
}
