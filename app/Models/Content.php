<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  use HasFactory, HasUuids;

  protected $table = "contents";
  protected $fillable = [
    'sub_id', 'user_id', 'description', 'content'
  ];

  public function sub()
  {
    return $this->belongsTo(Sub::class, 'sub_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function getCreatedAtAttribute($value)
  {
    return Carbon::parse($value)->diffForHumans();
  }

  public function getUpdatedAtAttribute($value)
  {
    return Carbon::parse($value)->diffForHumans();
  }

}
