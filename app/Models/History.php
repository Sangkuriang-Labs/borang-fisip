<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
  use HasUuids;

  protected $fillable = [
    'name', 'sub_id'
  ];

  public function sub()
  {
    return $this->belongsTo(Sub::class, 'sub_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
