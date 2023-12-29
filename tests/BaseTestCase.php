<?php

namespace AchyutN\LaravelComment\Tests;

use AchyutN\LaravelComment\CommentServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class BaseTestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom([
            '--database' => 'comment_test',
            '--realpath' => realpath(__DIR__ . '/database/migrations'),
        ]);

        include_once __DIR__ . '/../database/migrations/comments_table.stub.php';
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'comment_test');
        $app['config']->set('database.connections.comment_test', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    public function getPackageProviders($app): array
    {
        return [
            CommentServiceProvider::class,
        ];
    }
}