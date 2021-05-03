<?php


namespace Aankhijhyaal\Discuss\Models;


use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class CacheableModel extends Model
{
  use Cachable;
}
