<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
  use HasFactory, HasUuids;

  protected $table = "standards";
  protected $fillable = [
    'number', 'name'
  ];

  public function subs()
  {
    return $this->hasMany(Sub::class);
  }
}
