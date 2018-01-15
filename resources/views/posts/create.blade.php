@extends('layouts.master') 
@section('content')
<form method = "POST" action="/posts">
    {{ csrf_field() }}
    <div class="form-group">
		<label for="exampleInputEmail1">post title</label>
		<input name = "title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="post title" required>
	</div>
	<div class="form-group">
		<label for="exampleInputPassword1">post body</label>
		<textarea name = "content" type="text" class="form-control" id="exampleInputPassword1" placeholder="post body" > </textarea>
	</div>
	<button type="submit" class="btn btn-primary">create post</button>
</form>
@endsection