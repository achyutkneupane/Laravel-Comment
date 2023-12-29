<?php

namespace AchyutN\LaravelComment\Tests\Models;

use AchyutN\LaravelComment\Tests\Factories\UserFactory;
use Illuminate\Database\Eloquent\Model;
use AchyutN\LaravelComment\Traits\CanComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class User extends Model
{
    use CanComment;
    protected $guarded = [];
    protected static function factory(int $count = 1): Factory
    {
        if($count && $count > 1) {
            return UserFactory::times($count);
        } else {
            return UserFactory::new();
        }
    }
}