<?php


namespace Aankhijhyaal\Discuss\Http\Controllers;

use Aankhijhyaal\Discuss\Http\Requests\ThreadRequest;
use Aankhijhyaal\Discuss\Models\Category;
use Aankhijhyaal\Discuss\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class ThreadController extends Controller
{

  public function index()
  {
    return view('discuss::post');
  }


  public function store(ThreadRequest $request)
  {

    $uuid = Str::uuid()->toString();
    $slug = Str::slug($request->title,'-').'-'.$uuid;

    $category = Category::where('slug',$request->category)->first();

    $thread = auth()->user()->threads()->create([
        'uuid'=>$uuid,
        'title'=>$request->title,
        'text'=>$this->generateMarkup($request->text),
        'slug'=>$slug,
        'anonymous'=>$request->has('anonymous'),
        config('discuss.threads.category_key')=>$category->id
    ]);


    return $request->expectsJson()? response()->json(['message','Thread created'],200)
        :redirect()->back()->with('success','Thread created successfully');

  }




  public function show(Request $request,$slug)
  {

    $thread = Thread::with(['discussant','replies','category'])
        ->where('slug',$slug)->first();
    if(!$thread){
      abort(404);
    }

    $views = $thread->views;



    if($request->hasCookie('viewed-threads')){
      $viewedThreads = json_decode($request->cookie('viewed-threads'));
      if(!collect($viewedThreads)->contains($thread->uuid)){
        $thread->update([
            'views'=>$views + 1
        ]);

        array_push($viewedThreads,$thread->uuid);

      }
    } else {

      $thread->update([
          'views'=>$views + 1
      ]);
      $viewedThreads = [$thread->uuid];
    }

    Cookie::queue('viewed-threads',json_encode($viewedThreads));

    return view('discuss::thread',compact('thread'));
  }

  public function edit($uuid)
  {
    $thread = auth()->user()->threads()
        ->with(['category','replies','discussant'])
        ->where('uuid',$uuid)
        ->first();

    if(!$thread){
      abort(404);
    }

    $categories = Category::all();


    return view('discuss::thread-update',compact('thread','categories'));

  }

  public function update(ThreadRequest $request, $uuid)
  {
    $thread = auth()->user()->threads()
        ->where('uuid',$uuid)
        ->first();
    if(!$thread){
      abort(404);
    }

    $category = Category::where('slug',$request->category)->first();

    $slug = Str::slug($request->title,'-').'-'.$uuid;

    $thread->update([
        'title'=>$request->title,
        'text'=>$this->generateMarkup($request->text),
        'slug'=>$slug,
        'anonymous'=>$request->has('anonymous'),
        config('discuss.threads.category_key')=>$category->id
    ]);


    return $request->expectsJson()? response()->json(['message','Thread updated'],200)
        :redirect()->back()->with('success','Thread updated successfully');


  }


  public function close(Request $request, $uuid)
  {
    $thread = auth()->user()->threads()
        ->where('uuid',$uuid)
        ->first();
    if(!$thread){
      abort(404);
    }

    $thread->update([
        'closed'=>!$thread->closed
    ]);

    return $request->expectsJson()? response()->json(['message','Thread closed'],200)
        :redirect()->back()->with('success','Thread closed successfully');


  }

  public function destroy(Request $request, $uuid)
  {
    $thread = auth()->user()->threads()
        ->where('uuid',$uuid)
        ->first();
    if(!$thread){
      abort(404);
    }

    $thread->delete();

    return $request->expectsJson()? response()->json(['message','Thread deleted'],200)
        :redirect()->route('discussion')->with('success','Thread deleted successfully');

  }

}
