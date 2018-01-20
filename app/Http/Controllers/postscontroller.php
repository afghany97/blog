<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Reply;
use App\Like;
use App\User;

// use Illuminate\Support\Facades\Auth;

class postscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->Middleware('auth')->except(['index' , 'show']);
    }
    protected function index()
    {
        return view('posts.posts' , ['posts' => Post::latest()->Filter(request(['month', 'year']))->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|unique:posts|max:50',
            'content' => 'required|min:10'
        ]);
        $post = Post::create($request->all());
        $post->update(['user_id' => \Auth::id()]);
        session()->flash('message' , 'your post created successfully');
        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function show($id)
    {
        $post = Post::findOrFail($id);
        $comments  = $post->comment;
        $replies = $post->reply;
        $isPostHaveLikes = Like::isThisPostLiked(\Auth::id(),$id); 
        $postLikes = Like::where([['post_id' , '=' , $id] , ['comment_id' , '=' , null] , ['reply_id' , '=' , null]])->count();
        return view('posts.post',compact(['postLikes','post','comments','replies','id','isPostHaveLikes']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function edit($id)
    {
        return view('posts.edit',['post' => Post::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update(['title' => $request->input('title') , 'content' => $request->input('content')]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        $counter = Comment::where('post_id' , '=' , $id)->count();
        $comments = Comment::where('post_id','=',$id)->get();
        for($i = 0; $i < $counter; $i++)
        {
                $reply = Reply::where('comment_id' , '=' , $comments[$i]['id'])->delete(); 
                $comment = Comment::where('post_id','=',$id)->delete();
        }
        return redirect('posts');    
    }
}
