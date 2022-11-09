<?php

namespace App\Models;

use App\Enums\HistoryOperation;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
  use HasUuids;

  protected $fillable = [
    'name', 'sub_id', 'operation'
  ];

  protected $casts = [
    'operation' => HistoryOperation::class
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
