@extends('layouts.master')

@section("content")
  
    @foreach($posts as $post)
        <div class="blog-post">
            <a href="/post/{{$post->id}}"><h2 class="blog-post-title">{{$post->title}} </h2></a>
            <P class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} </p>
            <p class="blog-post-meta">{{$post->content}}</p>
        </div>
    @endforeach
        
@endsection
