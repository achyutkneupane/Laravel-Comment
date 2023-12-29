<?php

namespace AchyutN\LaravelComment\Tests;

use AchyutN\LaravelComment\CommentServiceProvider;
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
        $this->artisan('migrate', ['--database' => 'pers_laratest_test'])->run();
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'pers_laratest_test');
        $app['config']->set('database.connections.pers_laratest_test', [
            'driver'   => 'mysql',
            'host'     => '127.0.0.1',
            'port'     => 3306,
            'username' => 'root',
            'password' => '',
            'database' => 'pers_laratest_test',
            'prefix'   => '',
        ]);
        $app['config']->set('comment.table_name', 'comments');
    }

    public function getPackageProviders($app): array
    {
        return [
            CommentServiceProvider::class,
        ];
    }
}