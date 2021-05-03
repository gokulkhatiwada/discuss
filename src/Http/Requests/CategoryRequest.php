<?php


namespace Aankhijhyaal\Discuss\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
        'name'=>'required|string|max:50|min:3'
    ];
  }

  public function messages()
  {
    return [
        'name.required'=>'Category name is required.',
        'name.string'=>'Invalid category name',
        'name.max'=>'Invalid category name(max:50)',
        'name.min'=>'Invalid category name(min:3)'
    ];
  }
}
