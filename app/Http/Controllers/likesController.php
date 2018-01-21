<?php

namespace App\Http\Controllers;

use App\Like;

use App\User;

use Illuminate\Http\Request;

class likesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Like::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {

    }
    public function postLikes()
    {
        $likes = Like::where(
            [
                ['post_id' , '=' , request('post_id')] ,
                ['comment_id' , '=' , null] ,
                ['reply_id' , '=' , null]
            ])
        ->pluck('user_id');
        
        $users = [];
        
        $counter = 0;
        
        foreach($likes as $user_id)
        {
            $users[$counter++] = User::find($user_id)->name;
        }
        
        return view('likes.view' , ['users' => $users]);
    }

    public function commentLikes()
    {
        $likes = Like::where(
            [
                ['post_id' , '=' , request('post_id')] ,
                ['comment_id' , '=' , request('comment_id')] ,
                ['reply_id' , '=' , null]
        ])
        ->pluck('user_id');
        
        $users = [];
        
        $counter = 0;
        
        foreach($likes as $user_id)
        
            $users[$counter++] = User::find($user_id)->name;

        return view('likes.view' , ['users' => $users]);

    }
    public function replyLikes()
    {
        $likes = Like::where(
            [
                ['post_id' , '=' , request('post_id')] ,
                ['comment_id' , '=' , request('comment_id')] ,
                ['reply_id' , '=' , request('reply_id')]
        ])
        ->pluck('user_id');
        
        $users = [];
        
        $counter = 0;
        
        foreach($likes as $user_id)
        {
            $users[$counter++] = User::find($user_id)->name;
        }
        
        return view('likes.view' , ['users' => $users]);
    }
    
    public function deletePostLike()
    {
        $like = Like::where(
            [
                ['user_id' , '=' , request('user_id')] ,
                ['post_id' , '=' , request('post_id')] ,
                ['comment_id' , '=' , null]  ,
                ['reply_id' , '=' , null]
            ])
        ->delete();
        
        return back();
    }
    
    public function deleteCommentLike()
    {
        $like = Like::where(
            [
                ['user_id' , '=' , request('user_id')] ,
                ['post_id' , '=' , request('post_id')] ,
                ['comment_id' , '=' , request('comment_id')]  ,
                ['reply_id' , '=' , null]
            ])
        ->delete();
        
        return back();
    }
    
    public function deleteReplyLike()
    {
        $like = Like::where(
            [
                ['user_id' , '=' , request('user_id')] ,
                ['post_id' , '=' , request('post_id')] ,
                ['comment_id' , '=' , request('comment_id')] ,
                ['reply_id' , '=' , request('reply_id')]
            ])
        ->delete();
        
        return back();
    }
}
