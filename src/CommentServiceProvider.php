<?php

namespace AchyutN\LaravelComment;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        $this->publishes([
            __DIR__ . '/../config/comment.php' => config_path('comment.php'),
        ], 'config');

        if (method_exists($this, 'publishes')) {
            if (!Schema::hasTable(config('comment.table_name'))) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/comments_table.stub.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_comments_table.php'),
                ], 'migrations');
            }
            $this->publishes([
                __DIR__ . '/Factories/CommentFactory.php' => database_path('factories/CommentFactory.php')
            ], 'factories');
        }
    }

    public function register() : void
    {
        //
    }
}