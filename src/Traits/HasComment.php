<?php

namespace AchyutN\LaravelComment\Traits;

use AchyutN\LaravelComment\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasComment
{
    public function comments() : MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function replies() : MorphMany
    {
        return $this->morphManyThrough(Comment::class, Comment::class, 'commentable');
    }
}