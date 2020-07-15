<?php

namespace App;
use App\BlogPost;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['description','blog_post_id','user_id'];

    public function post()
    {
      return $this->belongsto(BlogPost::class);
    }
    public function user()
    {
      return $this->belongsto(User::class);
    }
}
