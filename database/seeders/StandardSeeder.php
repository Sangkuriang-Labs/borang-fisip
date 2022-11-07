<?php

namespace Database\Seeders;

use App\Models\Standard;
use Illuminate\Database\Seeder;

class StandardSeeder extends Seeder
{
  public function run()
  {
    Standard::create(['name' => 'Visi, Misi & Tujuan', 'number' => '1']);
    Standard::create(['name' => 'Tata Pamong, Tata Kelola dan Kerjasama', 'number' => '2']);
    Standard::create(['name' => 'Mahasiswa', 'number' => '3']);
    Standard::create(['name' => 'Sumber Daya Manusia', 'number' => '4']);
    Standard::create(['name' => 'Keuangan, Sarana dan Prasarana', 'number' => '5']);
    Standard::create(['name' => 'Pendidikan', 'number' => '6']);
    Standard::create(['name' => 'Penelitian', 'number' => '7']);
    Standard::create(['name' => 'Pengabdian Pada Masyarakat', 'number' => '8']);
    Standard::create(['name' => 'Luaran dan Capaian Tridharma', 'number' => '9']);
  }
}
