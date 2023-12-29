<?php

namespace AchyutN\LaravelComment\Traits;

use AchyutN\LaravelComment\Models\Comment;

trait HasComment
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function replies()
    {
        return $this->morphManyThrough(Comment::class, Comment::class, 'commentable');
    }
}