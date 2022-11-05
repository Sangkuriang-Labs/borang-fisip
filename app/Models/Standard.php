<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
  use HasFactory;

  protected $fillable = [
    'name'
  ];

  public function subs()
  {
    return $this->hasMany(Sub::class);
  }
}
