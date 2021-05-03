<?php


namespace Aankhijhyaal\Discuss\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends CacheableModel
{
  protected $guarded = ['id'];

  public function getTable()
  {
    return config('discuss.replies.table_name');
  }

  public function discussant()
  {
    return $this->morphTo(config('discuss.replies.user_morph_key'));
  }

  public function thread()
  {
    return $this->belongsTo(config('discuss.threads.model'),config('discuss.replies.thread_key'));
  }

  public function replies()
  {
    return $this->hasMany(self::class,config('discuss.replies.parent_key'));
  }

  public function parentReply()
  {
    return $this->belongsTo(self::class,config('discuss.replies.parent_key'));
  }
}
