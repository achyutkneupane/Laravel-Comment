<?php

namespace AchyutN\LaravelComment\Tests;

use AchyutN\LaravelComment\CommentServiceProvider;
use AchyutN\LaravelComment\Tests\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class BaseTestCase extends Orchestra
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->artisan('migrate', ['--database' => 'comment_test'])->run();
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.connections.pers_laratest_test', [
            'driver'   => 'mysql',
            'host'     => '127.0.0.1',
            'port'     => 3306,
            'username' => 'root',
            'password' => '',
            'database' => 'pers_laratest_test',
            'prefix'   => '',
        ]);
        $app['config']->set('database.connections.comment_test', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('database.default', 'comment_test');
        $app['config']->set('comment.table_name', 'comments');
        $app['config']->set('comment.commenter_model', User::class);
        $app['config']->set('comment.manual_approval', true);
    }

    public function getPackageProviders($app): array
    {
        return [
            CommentServiceProvider::class,
        ];
    }
}