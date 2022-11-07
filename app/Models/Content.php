<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  use HasFactory, HasUuids;

  protected $fillable = [
    'sub_id', 'user_id', 'description', 'content'
  ];

  public function sub()
  {
    $this->belongsTo(Sub::class, 'sub_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
