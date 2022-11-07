<?php

namespace Database\Seeders;

use App\Models\Standard;
use App\Models\Sub;
use Illuminate\Database\Seeder;

class SubSeeder extends Seeder
{
  public function run()
  {
    $standard = Standard::first();

    Sub::create(['name' => 'Visi', 'number' => '1.1', 'standard_id' => $standard->id]);
    Sub::create(['name' => 'Misi', 'number' => '1.2', 'standard_id' => $standard->id]);
    Sub::create(['name' => 'Tujuan', 'number' => '1.3', 'standard_id' => $standard->id]);

    $standard = Standard::all();

    Sub::create(['name' => 'Tata Pamong', 'number' => '2.1', 'standard_id' => $standard[1]->id]);
  }
}
