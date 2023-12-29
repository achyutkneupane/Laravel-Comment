<?php

namespace AchyutN\LaravelComment\Tests\Models;

use AchyutN\LaravelComment\Tests\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use AchyutN\LaravelComment\Traits\HasComment;

class Article extends Model
{
    use HasComment;
    protected $guarded = [];
    protected static function factory(int $count = 1): Factory
    {
        if($count && $count > 1) {
            return ArticleFactory::times($count);
        } else {
            return ArticleFactory::new();
        }
    }
}