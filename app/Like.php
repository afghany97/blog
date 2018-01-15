<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];
    static public function isThisPostLiked($user_id , $post_id)
    {
        if(Like::where([['user_id' , '=' , $user_id],['post_id' , '=' , $post_id] , ['comment_id' , '=' , null] , ['reply_id' , '=' , null]])->count())
        {
            return true;
        }
        return false;
    }
    static public function isThisCommentLiked($user_id , $post_id , $comment_id)
    {
        if(Like::where([['user_id' ,'=' , $user_id ],['post_id' , '=' , $post_id] , ['comment_id' , '=' , $comment_id], ['reply_id' , '=' , null]])->count())
        {
            return true;
        }
        return false;
    }
    static public function isThisReplyLiked($user_id , $post_id , $comment_id , $reply_id)
    {
        if(Like::where([['user_id' ,'=' , $user_id ],['post_id' , '=' , $post_id] , ['comment_id' , '=' , $comment_id] , ['reply_id' , '=' , $reply_id]])->count())
        {
            return true;
        }
        return false;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }
}
