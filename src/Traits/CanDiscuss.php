<?php


namespace Aankhijhyaal\Discuss\Traits;


trait CanDiscuss
{
  abstract function getDisplayName();

  abstract function getProfileUrl();

  abstract function getImageUrl();

  public function threads()
  {
    return $this->morphMany(config('discuss.threads.model'),config('discuss.threads.user_morph_key'));
  }

  public function replies()
  {
    return $this->morphMany(config('discuss.replies.model'),config('discuss.replies.user_morph_key'));
  }

}
