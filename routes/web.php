<?php

use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
  return \Illuminate\Support\Facades\Redirect::to('/dashboard');
});

Route::get('/dashboard', function () {
  return Inertia::render('Testing');
});

Route::resource('/standards', ContentController::class)->only('create', 'index', 'store', 'show');
