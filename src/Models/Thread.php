<?php


namespace Aankhijhyaal\Discuss\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends CacheableModel
{
  use SoftDeletes;
  protected $fillable = ['uuid','title','text','slug','discuss_category_id',
    'discussant_type','discussant_id','anonymous','views','closed','last_reply_at',
    'deleted_at'
  ];

  protected $dates = ['last_reply_at'];

  public function getTable()
  {
    return config('discuss.threads.table_name');
  }

  public function discussant()
  {
    return $this->morphTo(config('discuss.threads.user_morph_key'));
  }

  public function category()
  {
    return $this->belongsTo(config('discuss.categories.model'),config('discuss.threads.category_key'));
  }

  public function replies()
  {
    return $this->hasMany(config('discuss.replies.model'),config('discuss.replies.thread_key'));
  }
}
