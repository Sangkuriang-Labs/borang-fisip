<?php

namespace Database\Seeders;

use App\Enums\HistoryOperation;
use App\Models\History;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
  public function run()
  {
    History::create([
      'sub_id' => Sub::first()->id,
      'user_id' => User::first()->id,
      'operation' => HistoryOperation::Create
    ]);
  }
}
