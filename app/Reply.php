<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];
    
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    public function like()
    {
        return $this->hasMany(Like::class);
    }

}
