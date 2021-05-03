<?php


namespace Aankhijhyaal\Discuss\Events;


use Aankhijhyaal\Discuss\Models\Thread;
use Illuminate\Queue\SerializesModels;

class DiscussBeforeReplyCreateEvent
{
  use SerializesModels;

  public $thread;

  public function __construct(Thread $thread)
  {
    $this->thread = $thread;
  }
}
