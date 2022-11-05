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
    $standards = Standard::all()->map(function ($standard) {
      return [
        'value' => $standard->id,
        'display' => "$standard->number - $standard->name",
      ];
    });

    $subs = Sub::when($request->get('standardId'), function ($query) use ($request) {
      return $query->where('standard_id', $request->get('standardId'));
    })->get()->map(function ($sub) {
      return [
        'value' => $sub->id,
        'display' => "$sub->number - $sub->name",
      ];
    });;

    return Inertia::render('', [
      'standards' => $standards,
      'subs' => $subs
    ]);
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
