<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  use HasFactory;

  protected $fillable = [
    'content', 'description', 'standard_id', 'sub_id'
  ];

  public function sub()
  {
    $this->belongsTo(Sub::class);
  }
}
