<?php

namespace Aankhijhyaal\Discuss\Http\Controllers;


use Aankhijhyaal\Discuss\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
  public function index()
  {
    return view('discuss::categories');
  }

  public function store(CategoryRequest $request)
  {
    config('discuss.categories.model')::findOrCreate([
        'name'=>$request->name,
        'slug'=>Str::slug($request->name,'-'),
        'color'=>$request->colour
    ]);
    return redirect()->back()->with('success','Category created successfully.');
  }

  public function update(CategoryRequest $request,$slug)
  {
    $category = config('discuss.categories.model')::where('slug',$slug)->first();
    if(!$category){
      abort(404);
    }
    $category->update([
        'name'=>$request->name,
        'slug'=>Str::slug($request->name,'-'),
        'color'=>$request->colour
    ]);
    return redirect()->back()->with('success','Category updated successfully');
  }
}
