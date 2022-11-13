<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable, HasUuids;

  protected $table = "users";
  protected $fillable = [
    'name',
    'email',
    'password',
    'position_id',
    'major_id'
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function major()
  {
    return $this->belongsTo(Major::class, 'major_id', 'id');
  }

  public function contents()
  {
    return $this->hasMany(Content::class, 'user_id', 'id');
  }
}
