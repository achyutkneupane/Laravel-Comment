<?php

namespace AchyutN\LaravelComment\Tests;

use AchyutN\LaravelComment\Models\Comment;
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
    public function test_article_can_have_comment_by_user()
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

    /** @test */
    public function test_user_can_comment_on_article()
    {
        $user = $this->createUser();
        $article = $this->createArticle();

        $user->comments()->create([
            'content' => $this->faker->paragraph,
            'commentable_id' => $article->id,
            'commentable_type' => get_class($article)
        ]);

        $this->assertCount(1, $article->comments);
        $this->assertEquals($user->comments->first()->comment, $article->comments->first()->comment);
    }

    /** @test */
    public function test_multiple_approved_comment_for_article_with_random_user_ids()
    {
        $this->createUsers(5);
        $article = $this->createArticle();

        $article->comments()->createMany(
            Comment::factory()->count(5)->approved()->make()->toArray()
        );

        $this->assertCount(5, $article->comments);
        $this->assertEquals(5, $article->comments()->approved()->count());
        foreach ($article->comments as $comment) {
            $this->assertNotNull($comment->approved_at);
        }
    }

    /** @test */
    public function test_multiple_pending_comment_for_article_with_random_user_ids()
    {
        $this->createUsers(5);
        $article = $this->createArticle();

        $article->comments()->createMany(
            Comment::factory()->count(5)->pending()->make()->toArray()
        );

        $this->assertCount(5, $article->comments);
        $this->assertEquals(5, $article->comments()->pending()->count());
        foreach ($article->comments as $comment) {
            $this->assertNull($comment->approved_at);
        }
    }

    /** @test */
    public function test_approve_method()
    {
        $user = $this->createUser();
        $article = $this->createArticle();

        $comment = $article->comments()->create([
            'content' => $this->faker->paragraph,
            'commenter_id' => $user->id,
            'commenter_type' => get_class($user)
        ]);

        $this->assertNull($comment->approved_at);
        $comment->approve();
        $this->assertNotNull($comment->approved_at);
    }
}