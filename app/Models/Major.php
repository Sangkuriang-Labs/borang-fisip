<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
  use HasUuids;

  protected $fillable = [
    'name',
  ];

  public function majors()
  {
    return $this->hasMany(User::class, 'major_id', 'id');
  }
}
