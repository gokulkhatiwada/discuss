<?php


namespace Aankhijhyaal\Discuss\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes;
  protected $guarded = [
      'id'
  ];

  public function getTable()
  {
    return config('discuss.categories.table_name');
  }

  public function parent()
  {
    return $this->belongsTo(self::class,config('discuss.categories.parent_key'));
  }

  public function children()
  {
    return $this->hasMany(self::class,config('discuss.categories.parent_key'));
  }

  public function threads()
  {
    return $this->hasMany(Thread::class,config('discuss.threads.category_key'));
  }
}
