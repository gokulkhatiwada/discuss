<?php


namespace Aankhijhyaal\Discuss\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
        'title'=>'required|string|max:200',
        'text'=>'required',
        'category'=>'required|exists:'.config('discuss.categories.table_name').','.'slug'
    ];
  }

  public function messages()
  {
    return [
        'title.required'=>'Thread title is required',
        'title.string'=>'Title must reflect your text.',
        'title.max'=>'Make it short and sweet(max:200)',
        'text.required'=>'Thread text is required',
        'category.required'=>'Select any category',
        'category.exists'=>'Selected category not found'
    ];
  }
}
