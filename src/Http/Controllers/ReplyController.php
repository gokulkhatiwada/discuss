<?php


namespace Aankhijhyaal\Discuss\Http\Controllers;


use Aankhijhyaal\Discuss\Models\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
  public function store(Request $request,$uuid)
  {
    $request->validate([
        'text'=>'required'
    ], [
        'text.required'=>'Your reply can\'t be empty'
    ]);

    $thread = Thread::where('uuid',$uuid)->first();
    if(!$thread){
      abort(404);
    }

    auth()->user()->replies()->create([
      'body'=>$this->generateMarkup($request->text),
      'anonymous'=>$request->has('anonymous'),
      config('discuss.replies.thread_key')=>$thread->id
    ]);

    $thread->update([
        'last_reply_at'=>now()
    ]);

    return redirect()->back();

  }
}
