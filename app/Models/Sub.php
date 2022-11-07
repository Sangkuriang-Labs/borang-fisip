<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
  use HasFactory, HasUuids;

  protected $fillable = [
    'standard_id', 'number', 'name'
  ];

  public function standard()
  {
    return $this->belongsTo(Standard::class);
  }

  public function contents()
  {
    return $this->hasMany(Content::class);
  }
}
