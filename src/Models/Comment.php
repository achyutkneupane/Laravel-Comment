<?php

namespace AchyutN\LaravelComment\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use AchyutN\LaravelComment\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'approved_at' => 'datetime',
    ];
    protected static function factory(int $count = 1): Factory
    {
        if($count && $count > 1) {
            return CommentFactory::times($count);
        } else {
            return CommentFactory::new();
        }
    }
    public function commentable() : MorphTo
    {
        return $this->morphTo();
    }
    public function commenter() : MorphTo
    {
        return $this->morphTo();
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function replies() : HasMany
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function approve()
    {
        $this->approved_at = now();
        $this->save();
    }

    public function scopeApproved($query)
    {
        return $query->where('approved_at', '!=', null);
    }

    public function scopePending($query)
    {
        return $query->where('approved_at', null);
    }
}
