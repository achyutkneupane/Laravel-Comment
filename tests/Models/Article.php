<?php

namespace AchyutN\LaravelComment\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use AchyutN\LaravelComment\Traits\HasComment;

class Article extends Model
{
    use HasComment;
    protected $guarded = [];
}