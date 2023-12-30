<?php

namespace AchyutN\LaravelComment;

use AchyutN\LaravelComment\Models\Comment;
use AchyutN\LaravelComment\Observers\CommentObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        /**
         * Register the Comment model observer
         */
        Comment::observe(CommentObserver::class);

        $this->publishes([
            /**
             * Publish the config file
             */
            __DIR__ . '/../config/comment.php' => config_path('comment.php'),
        ], 'config');

        if (method_exists($this, 'publishes')) {
            /**
             * Publish the migration file.
             *
             * If the table already exists, it will not be re-created.
             */
            if (!Schema::hasTable(config('comment.table_name'))) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/comments_table.stub.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_comments_table.php'),
                ], 'migrations');
            }
            $this->publishes([
                /**
                 * Publish the Comment Factory
                 */
                __DIR__ . '/Factories/CommentFactory.php' => database_path('factories/CommentFactory.php')
            ], 'factories');
        }
    }

    public function register() : void
    {
        //
    }
}