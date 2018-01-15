@extends('layouts.master') 
@section('content')
<form method = "POST" action="{{$post->id}}">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="form-group">
		<label for="exampleInputEmail1">post title</label>
		<input value="{{$post->title}}" name = "title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="post title" required>
	</div>
	<div class="form-group">
		<label for="exampleInputPassword1">post body</label>
		<input value="{{$post->content}}" name = "content" type="text" class="form-control" id="exampleInputPassword1" placeholder="post body" >
	</div>
	<button type="submit" class="btn btn-primary">Update Post</button>
</form>
@endsection