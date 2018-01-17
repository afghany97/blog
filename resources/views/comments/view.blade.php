<ul>
    @foreach($comments as $comment)
            <div>
                    {{$comment->created_at->diffForHumans()}} by {{$comment->user->name}} {{--  how to do this in controller ... how to fetch the comment object  --}} : <br>
                    <li class="form-control"> {{$comment->content}}  
                            {{--  start delete comment section  --}}
                            @if(\Auth::id() == $post->user_id || \Auth::id() == $comment->user_id)
                                    <form method="post" action="{{$post->id}}\delete-comment">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-primary">Delete Comment</button>
                                    </form>
                            @endif
                            {{--  end delete comment section  --}}
                            {{--  start like a comment section  --}}
                            @if(!(\App\Like::isThisCommentLiked(\Auth::id(),$post->id,$comment->id))){{--  how to do this in controller the problem with how to fetch the id of specific comment  --}}
                                    <form method="post" action="{{$post->id}}/like-comment">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_id" value="{{\Auth::id()}}" />
                                            <input type="hidden" name="post_id" value="{{$post->id}}" />
                                            <input type="hidden" name="comment_id" value="{{$comment->id}}" />
                                            <button type="submit" class="btn btn-primary">Like</button>           
                                    </form>
                            @endif
                            {{--  end like a comment section  --}}  
                            {{--  start unlike a comment section  --}}                                                                                              
                            @if(\App\Like::isThisCommentLiked(\Auth::id(), $post->id,$comment->id))
                                    <form method="post" action="{{$post->id}}/unlike-comment">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_id" value="{{\Auth::id()}}" />
                                            <input type="hidden" name="post_id" value="{{$post->id}}" />
                                            <input type="hidden" name="comment_id" value="{{$comment->id}}" />                                        
                                            <button type="submit" class="btn btn-primary">UnLike</button>           
                                    </form>
                            @endif
                            {{--  end unlike a comment section  --}}    
                            {{--  start number of like on comment section --}}
                            @if(\App\Like::where([['post_id' , '=' , $post->id] , ['comment_id' , '=' ,$comment->id] , ['reply_id' , '=' , null]])->count()) {{--  how to do this in controller the problem with how to fetch the id of specific comment  --}}
                                    <form method="post" action="{{$post->id}}/comment-likes">
                                                    Liked by 
                                                    {{ csrf_field() }}
                                                    {{--    --}}
                                                    <input type="hidden" name="post_id" value="{{$post->id}}" />
                                                    <input type="hidden" name="comment_id" value="{{$comment->id}}" />
                                                    <button type="submit" class="btn btn-primary">{{\App\Like::where([['post_id' , '=' , $post->id] , ['comment_id' , '=' ,$comment->id] , ['reply_id' , '=' , null]])->count()}} </button>           
                                    </form>
                            @endif
                            {{--  end number of like on comment section --}}                                                
                    </li>
            </div>
            {{-- start replies section--}}
            @include('replies.view')
            {{--  start add reply section       --}}
            <li class="form-control">   
                    <form method = "POST" action="add-reply">
                            {{ csrf_field() }}
                            <div class="form-group">
                                    <label for="exampleInputEmail1"></label>
                                    <input name="content" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add Reply" required>
                            </div>
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <input type="hidden" name="post_id" value="{{$id}}">
                            <input type="hidden" name="user_id" value="{{\Auth::id()}}">
                            <button type="submit" class="btn btn-primary">Add Reply</button>
                    </form> 
            </li>
            {{--  end add reply section  --}}
    @endforeach
    {{--  end replies section  --}}                        
</ul>
{{--  start add comment section  --}}
<form method = "POST" action="add-comment">
    {{ csrf_field() }}
    <div class="form-group">
            <label for="exampleInputEmail1"></label>
            <input name="content" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="your comment" required>
    </div>
    <input type="hidden" name="post_id" value="{{$id}}">
    <input type="hidden" name="user_id" value="{{\Auth::id()}}">
    <button type="submit" class="btn btn-primary">Add Comment</button>
</form>
{{--  end add comment section  --}}
{{--  end comment section  --}}
<hr>