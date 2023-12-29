<?php

return [
    /**
     * Database table name.
     *
     * By default, the table name is set to `comments`.
     */
    'table_name' => 'comments',
    /**
     * Model for Comment.
     *
     * By default, the model in this package is used.
     */
    'model' => \Achyutn\LaravelComment\Models\Comment::class,

    /**
     * Model for Commenter.
     *
     * By default, the default Laravel User model is used.
     */
    'commenter_model' => \App\Models\User::class,

    /**
     * Level of nested replies.
     *
     * By default, the level is set to 3.
     * You can change this to any number you want.
     */
    'nest_level' => 3,

    /**
     * Manual approval of comments.
     *
     * By default, the comments are approved automatically.
     * You can change this to false if you want to approve comments manually.
     */
    'manual_approval' => false,
];