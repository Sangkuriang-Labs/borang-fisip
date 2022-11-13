<?php

namespace App\Actions\Fortify;

use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
  use PasswordValidationRules;

  /**
   * Validate and create a newly registered user.
   *
   * @param array $input
   * @return \App\Models\User
   */
  public function create(array $input)
  {
    $positionDekan = Position::where('name', 'Dekan')->first();

    Validator::make($input, [
      'position_id' => ['required', 'uuid'],
      'major_id' => ["exclude_if::position_id,$positionDekan->id"],
      'name' => ['required', 'string', 'max:255'],
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        'ends_with:@widyatama.ac.id',
        Rule::unique(User::class),
      ],
      'password' => $this->passwordRules(),
    ])->validate();

    return User::create([
      'name' => $input['name'],
      'email' => $input['email'],
      'password' => Hash::make($input['password']),
      'position_id' => $input['position_id'],
      'major_id' => $input['major_id'],
    ]);
  }
}
