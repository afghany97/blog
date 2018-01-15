@extends('layouts.master')

@section("content")
<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">
  
    @foreach($posts as $post)
        <div class="blog-post">
            <a href="/post/{{$post->id}}"><h2 class="blog-post-title">{{$post->title}} </h2></a>
            <P class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} </p>
            <p class="blog-post-meta">{{$post->content}}</p>
        </div>

    @endforeach
        
        </div>

@endsection
