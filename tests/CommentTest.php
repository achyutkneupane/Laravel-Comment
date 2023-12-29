<?php

namespace AchyutN\LaravelComment\Tests;

use AchyutN\LaravelComment\Tests\Models\User;
use AchyutN\LaravelComment\Tests\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;

class CommentTest extends BaseTestCase
{
    use WithFaker;
    public function createUser()
    {
        return User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('password')
        ]);
    }

    public function createUsers($count = 1)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->createUser();
        }
    }

    public function createArticle()
    {
        return Article::create([
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph
        ]);
    }

    public function createArticles($count = 1)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->createArticle();
        }
    }

    /** @test */
    public function test_user_can_comment_on_article()
    {
        $user = $this->createUser();
        $article = $this->createArticle();

        $comment = $article->comments()->create([
            'content' => $this->faker->paragraph,
            'commenter_id' => $user->id,
            'commenter_type' => get_class($user)
        ]);

        $this->assertCount(1, $article->comments);
        $this->assertEquals($comment->comment, $article->comments->first()->comment);
    }
}