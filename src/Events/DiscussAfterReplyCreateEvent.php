<?php


namespace Aankhijhyaal\Discuss\Events;


use Aankhijhyaal\Discuss\Models\Reply;
use Aankhijhyaal\Discuss\Models\Thread;
use Illuminate\Queue\SerializesModels;

class DiscussAfterReplyCreateEvent
{
  use SerializesModels;

  public $thread;

  public $reply;

  public function __construct(Thread $thread, Reply $reply)
  {
    $this->thread = $thread;
    $this->reply = $reply;
  }
}
