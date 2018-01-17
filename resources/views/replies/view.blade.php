@if($replies->all())
                    <ul>
                            @foreach($replies as $reply)
                                    @if($reply->comment_id == $comment->id)
                                            <div>
                                                    {{$reply->created_at->diffForHumans()}} by {{$reply->user->name}} :
                                                    <li class="form-control"> {{$reply->content}} 
                                                            {{--  start delete reply section  --}}
                                                            @if(\Auth::id() == $post->user_id || \Auth::id() == $reply->user_id)
                                                                    <form method="post" action="{{$post->id}}\delete-reply">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('delete') }}
                                                                            <input type="hidden" name="id" value="{{$comment->id}}"/>
                                                                            <button type="submit" class="btn btn-primary">Delete Reply</button>
                                                                    </form>
                                                            @endif
                                                            {{--  end delete reply section  --}}
                                                            {{--  start like reply section  --}}
                                                            @if(!(\App\Like::isThisReplyLiked(\Auth::id(),$post->id,$comment->id , $reply->id)))
                                                                    <form method="post" action="{{$post->id}}/like-reply">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="user_id" value="{{\Auth::id()}}" />
                                                                            <input type="hidden" name="post_id" value="{{$post->id}}" />
                                                                            <input type="hidden" name="comment_id" value="{{$comment->id}}" />
                                                                            <input type="hidden" name="reply_id" value="{{$reply->id}}" />
                                                                            <button type="submit" class="btn btn-primary">Like</button>           
                                                                    </form>
                                                            @endif
                                                            {{--  end like reply section  --}}
                                                            {{--  start  unlike reply section  --}}
                                                            @if(\App\Like::isThisReplyLiked(\Auth::id(), $post->id,$comment->id,$reply->id))
                                                                    <form method="post" action="{{$post->id}}/unlike-reply">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="user_id" value="{{\Auth::id()}}" />
                                                                            <input type="hidden" name="post_id" value="{{$post->id}}" />
                                                                            <input type="hidden" name="comment_id" value="{{$comment->id}}" />  
                                                                            <input type="hidden" name="reply_id" value="{{$reply->id}}" />                                                                                              
                                                                            <button type="submit" class="btn btn-primary">UnLike</button>           
                                                                    </form>
                                                            @endif
                                                            {{--  end unlike reply section  --}}
                                                            @if(\App\Like::where([['post_id' , '=' , $post->id] , ['comment_id' , '=' ,$comment->id] , ['reply_id' , '=' , $reply->id]])->count())
                                                                    <form method="post" action="{{$post->id}}/reply-likes">
                                                                                    Liked by 
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="reply_id" value="{{$reply->id}}" />
                                                                                    <input type="hidden" name="comment_id" value="{{$comment->id}}" />
                                                                                    <input type="hidden" name="post_id" value="{{$post->id}}" />
                                                                                    <button type="submit" class="btn btn-primary">{{\App\Like::where([['post_id' , '=' , $post->id] , ['comment_id' , '=' ,$comment->id] ,['reply_id' , '=' , $reply->id] ])->count()}} </button>           
                                                                    </form>
                                                            @endif
                                                    </li>
                                            </div>
                                    @endif
                            @endforeach
                    </ul>
            @endif