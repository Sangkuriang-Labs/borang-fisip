<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Major;
use App\Models\Position;
use App\Models\User;
use Cache;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Fortify::createUsersUsing(CreateNewUser::class);
    Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
    Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
    Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

    RateLimiter::for('login', function (Request $request) {
      $email = (string)$request->email;

      return Limit::perMinute(5)->by($email . $request->ip());
    });

    RateLimiter::for('two-factor', function (Request $request) {
      return Limit::perMinute(5)->by($request->session()->get('login.id'));
    });

    Fortify::loginView(function () {
      return Inertia::render('Auth/Login');
    });

    Fortify::authenticateUsing(function (Request $request) {
      $user = User::where('email', $request->email)->first();

      if ($user && \Hash::check($request->password, $user->password)) {
        return $user;
      }
    });

    Fortify::registerView(function () {
      $positions = Position::whereNot('name', 'Admin')->get()->map(function ($position) {
        return [
          'value' => $position->id,
          'display' => "$position->name",
        ];
      });

      $majors = Cache::rememberForever('major', fn() => Major::all()->map(function ($major) {
        return [
          'value' => $major->id,
          'display' => $major->name,
        ];
      }));

      $positionDekan = $positions->where('display', 'Dekan')->first();

      return Inertia::render('Auth/Register', compact('majors', 'positions', 'positionDekan'));
    });

    Fortify::requestPasswordResetLinkView(function () {
      return Inertia::render('Auth/ForgotPassword');
    });

    Fortify::resetPasswordView(function (Request $request) {
      return Inertia::render('Auth/ResetPassword', ['email' => $request, 'token' => $request->route('token')]);
    });

    Fortify::verifyEmailView(function () {
      return Inertia::render('Auth/VerifyEmail');
    });
  }
}
