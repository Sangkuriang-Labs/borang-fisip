<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Models\Content;
use App\Models\Standard;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;

class ContentController extends Controller
{
  public function index(Request $request)
  {
    $standards = Standard::all()->map(function ($standard) {
      return [
        'value' => $standard->id,
        'display' => "$standard->number - $standard->name",
      ];
    });

    $subs = Sub::with(['contents', 'standard'])->has('contents')->whereHas('contents', function ($content) {
      return $content->with('user')->whereHas('user', function ($user) {
        return $user->where('major_id', User::first()->major_id);
      });
    })->when($request->get('standard'), function ($sub) use ($request) {
      return $sub->whereHas('standard', function ($standard) use ($request) {
        return $standard->where('id', $request->get('standard'));
      });
    }, function ($sub) {
      return $sub->whereHas('standard', function ($standard) {
        return $standard->where('id', Standard::first()->id);
      });
    })->get();

    return Inertia::render('Contents/Index', compact('standards', 'subs'));
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

    return Inertia::render('Contents/Create', compact('subs', 'standards'));
  }

  public function store(StoreContentRequest $request)
  {
    $path = "";

    if ($request->hasFile('content')) {
      $path = $request->file('content')->store('content', 'public');
    }

    Content::create(['sub_id' => $request->get('subId'), 'user_id' => User::first()->id, 'description' => $request->get('description'), 'content' => $path]);

    return Redirect::route('standards.index')->with('notifications', 'Menambahkan dokumen baru.');
  }

  public function show(Request $request)
  {
    $arrayOfUri = explode("/", $request->getRequestUri());
    $idSub = collect($arrayOfUri)->last();

    $sub = Sub::with('contents', 'standard')->where('id', $idSub)->first();

    return Inertia::render('Contents/Show', compact('sub'));
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
