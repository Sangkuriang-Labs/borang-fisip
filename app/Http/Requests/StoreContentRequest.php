<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'subId' => 'required|uuid',
      'description' => 'required',
      'content' => 'required|file|mimes:pdf,docx|max:2048'
    ];
  }

  public function authorize(): bool
  {
    return true;
  }
}
