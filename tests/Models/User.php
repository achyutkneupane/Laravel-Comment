<?php

namespace AchyutN\LaravelComment\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use AchyutN\LaravelComment\Traits\CanComment;

class User extends Model
{
    use CanComment;
    protected $guarded = [];
}