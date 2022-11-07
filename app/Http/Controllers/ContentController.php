<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Models\Content;
use App\Models\Standard;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContentController extends Controller
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

    $subs = Sub::when($request->get('standard'), function ($query) use ($request) {
      return $query->where('standard_id', $request->get('standard'));
    }, function ($query) {
      return $query->where('name', '');
    })->get()->map(function ($sub) {
      return [
        'value' => $sub->id,
        'display' => "$sub->number - $sub->name",
      ];
    });

    return Inertia::render('Contents/Create', [
      'standards' => $standards,
      'subs' => $subs
    ]);
  }

  public function store(StoreContentRequest $request)
  {
    $path = "";
    if ($request->hasFile('content')) {
      $path = $request->file('content')->store('content', 'public');
    }
    Content::create(['sub_id' => $request->get('subId'), 'user_id' => User::first()->id, 'description' => $request->get('description'), 'content' => $path]);

    return \Redirect::route('contents.index')->with('notifications', 'Menambahkan dokumen baru.');
  }

  public function show(Content $content)
  {
  }

  public function edit(Content $content)
  {
  }

  public function update(Request $request, Content $content)
  {
  }

  public function destroy(Content $content)
  {
  }
}
