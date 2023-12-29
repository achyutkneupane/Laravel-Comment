<?php

return [
    /**
     * Database table name.
     *
     * By default, the table name is set to `comments`.
     */
    'table_name' => 'comments',

    /**
     * Model for Commenter.
     *
     * By default, the default Laravel User model is used.
     */
    'commenter_model' => \App\Models\User::class,

    /**
     * Manual approval of comments.
     *
     * By default, the comments are approved automatically.
     * You can change this to false if you want to approve comments manually.
     */
    'manual_approval' => false,
];