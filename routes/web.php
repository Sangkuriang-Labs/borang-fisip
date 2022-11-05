<?php

use App\Http\Controllers\StandardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return \Illuminate\Support\Facades\Redirect::to('/dashboard');
});

Route::get('/dashboard', function () {
  return Inertia::render('Testing');
});

Route::resource('/standards', StandardController::class)->only('create', 'index');

