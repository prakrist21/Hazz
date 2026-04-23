<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'content', 'likes_count', 'replies_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function savedBy()
    {
        return $this->hasMany(SavedPost::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'hashtag_post');
    }
}