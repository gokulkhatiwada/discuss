<?php


namespace Aankhijhyaal\Discuss\Http\Controllers;

use Aankhijhyaal\Discuss\Service\Parsedown;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function generateMarkup($string)
  {
    return (new Parsedown())->setSafeMode(true)->text($string);
  }
}
