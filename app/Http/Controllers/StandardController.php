<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use App\Models\Sub;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StandardController extends Controller
{
  public function index()
  {
    return Inertia::render('Testing');
  }

  public function create(Request $request)
  {
  }

  public function store(Request $request)
  {
  }

  public function show(Standard $standard)
  {
  }

  public function edit(Standard $standard)
  {
  }

  public function update(Request $request, Standard $standard)
  {
  }

  public function destroy(Standard $standard)
  {
  }
}
