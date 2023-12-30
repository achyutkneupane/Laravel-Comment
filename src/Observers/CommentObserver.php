<?php

namespace AchyutN\LaravelComment\Observers;

use AchyutN\LaravelComment\Models\Comment;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        $manualApproval = config('comment.manual_approval');

        if (!$manualApproval) {
            $comment->update([
                'approved_at' => now(),
            ]);
        }
    }
}