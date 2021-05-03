<?php


namespace Aankhijhyaal\Discuss\Http\Controllers;



use Aankhijhyaal\Discuss\Models\Category;
use Aankhijhyaal\Discuss\Models\Thread;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{

  public function index(Request $request)
  {
    $categories = Category::all();

    if(isset($request->filter) && $request->filter === 'my-threads'){
      $threads = $this->getUserThreads();
    } else if(isset($request->category)) {
      $threads = $this->getCategoryThreads($request->category);
    } else if(isset($request->filter) && $request->filter === 'popular'){
      $threads = $this->getPopularThreads();

    } else if(isset($request->filter) && $request->filter === 'participated'){
      $threads = $this->getMyParticipation();
    }
    else {
      $threads = Thread::with(['category','replies','discussant'])
          ->latest()
          ->limit(20)->get();
    }


    return view('discuss::discussion',compact('categories','threads'))
        ->with(['filter'=>$request->filter]);
  }

  public function getUserThreads()
  {
    return auth()->user()->threads()->with(['category','replies','discussant'])->latest()->limit(20)
        ->get()->sortByDesc(function($thread){
          return $thread->last_reply_at;
        });
  }

  public function getCategoryThreads($slug)
  {
    $category =  Category::where('slug',$slug)->first();
    if(!$category){
      abort(404);
    }

    return $category->threads()->with(['category','replies','discussant'])->get()->sortByDesc(function($thread){
      return $thread->last_reply_at;
    });

  }

  public function getPopularThreads()
  {
    return Thread::with(['category','replies','discussant'])->whereHas('replies')
        ->whereDate('created_at','>=',now()->subDays(7))
        ->get()->sortBy(function($thread){
          return $thread->replies->count();
        })->sortByDesc(function($thread){
          return $thread->last_reply_at;
        });
  }

  public function getMyParticipation()
  {
    return Thread::with(['category','replies','discussant'])->whereHas('discussant',function($query){
      $query->where('id',auth()->id());
    })->orWhereHas('replies',function($query){
      $query->where('discussant_id',auth()->id());
    })->get()->sortByDesc(function($thread){
      return $thread->last_reply_at;
    });
  }

}
