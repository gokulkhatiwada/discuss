<?php


namespace Aankhijhyaal\Discuss\Events;


use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class DiscussBeforeThreadCreateEvent
{
  use SerializesModels;

  public $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }


}
