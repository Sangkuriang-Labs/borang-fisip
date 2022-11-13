<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call([
      StandardSeeder::class,
      PositionSeeder::class,
      SubSeeder::class,
      MajorSeeder::class,
      UserSeeder::class,
    ]);
  }
}
