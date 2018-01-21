@extends('layouts.master')

@section("content")
@foreach($posts as $post)
    <div class="blog-post">
        <h2 class="blog-post-title">{{$post->title}} &#09 
        </h2>
        <P class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by {{$post->user->name}}</p>
        <p class="blog-post-meta">{{$post->content}}</p>
        
</div>
@endforeach
@endsection
