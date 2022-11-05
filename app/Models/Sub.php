<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
  use HasFactory;

  protected $fillable = [
    'number', 'name', 'standard_id'
  ];

  public function standard()
  {
    return $this->belongsTo(Standard::class);
  }

  public function content()
  {
    return $this->hasOne(Content::class);
  }

}
