<?php

namespace App;
use App\Comment;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class BlogPost extends Model
{
    use softDeletes;
    protected $date = ['deleted_at'];
    protected $fillable = ['image','title','content','view','user_id'];

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
