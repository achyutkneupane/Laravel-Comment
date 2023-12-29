<?php

namespace AchyutN\LaravelComment\Traits;

use AchyutN\LaravelComment\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanComment
{
    public function comments() : MorphMany
    {
        return $this->morphMany(Comment::class, 'commenter');
    }
}