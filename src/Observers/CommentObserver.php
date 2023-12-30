<?php

namespace AchyutN\LaravelComment\Observers;

use AchyutN\LaravelComment\Models\Comment;

class CommentObserver
{
    /**
     * Handle the Comment "creating" event.
     */
    public function creating(Comment $comment): void
    {
        /**
         * If the comment is pending, set approved_at to null by default
         */
        if($comment->pending || $comment->approved_at !== null) {
            unset($comment->pending);
            return;
        }

        $manualApproval = config('comment.manual_approval');

        if ($manualApproval === null) {
            $manualApproval = false;
        }

        if (!$manualApproval) {
            $comment->approved_at = now();
        } else {
            $comment->approved_at = null;
        }
    }
}