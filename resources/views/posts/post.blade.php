@extends('layouts.master')

@section("content")
                                <div class="blog-post">
        <h2 class="blog-post-title">{{$post->title}} &#09 
                @if(\Auth::check())
                {{--  start like section  --}}
                        @if(!($isPostHaveLikes))
                                <form method="post" action="{{$post->id}}/like-post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" value="{{\Auth::id()}}" />
                                        <input type="hidden" name="post_id" value="{{$post->id}}" />
                                        <button type="submit" class="btn btn-primary">Like</button>           
                                </form>
                        @endif
                        @if($isPostHaveLikes)
                                <form method="post" action="{{$post->id}}/unlike-post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" value="{{\Auth::id()}}" />
                                        <input type="hidden" name="post_id" value="{{$post->id}}" />
                                        <button type="submit" class="btn btn-primary">UnLike</button>           
                                </form>
                        @endif
                        @if($postLikes)
                        <form method="post" action="{{$post->id}}/post-likes">
                                Liked by 
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{\Auth::id()}}" />
                                <input type="hidden" name="post_id" value="{{$post->id}}" />
                                <button type="submit" class="btn btn-primary">{{\App\Like::where([['post_id' , '=' , $post->id] , ['comment_id' , '=' , null] , ['reply_id' , '=' , null]])->count()}}</button>           
                        </form>
                        @endif
                        {{--  end like section   --}}
                        {{--  start edit and delete section  --}}
                        @if(\Auth::id() == $post->user_id)
                                <form method="post" action="{{$post->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-primary">Edit Post</button>
                                </form>
                                <form method="post" action="{{$post->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-primary">Delete Post</button>           
                                </form>
                        @endif
                        {{--  end edit and delete section   --}}
                @endif

        </h2>
        <P class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by {{$post->user->name}}</p>
        <p class="blog-post-meta">{{$post->content}}</p>
        {{--  start comments section  --}}
        @if(\Auth::check())
            @include('comments.view')
        @endif
</div>

@endsection
