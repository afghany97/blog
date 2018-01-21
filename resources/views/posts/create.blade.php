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
		<textarea name = "content" type="text" class="form-control" id="exampleInputPassword1" placeholder="post body"></textarea>
	</div>
	@if(count($tags))
	<h5>Existing Tags</h5>
		<div class="form-group">
			<select multiple name="tags[]" class="form-control">
					@foreach($tags as $tag)
				  		<option value="{{$tag->name}}">{{$tag->name}}</option>
				  	@endforeach
			</select>
			<p> Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p> 
		</div>
		@endif
	<div class="form-group">
		<label for="post_tags">Add Tags</label>
		<input  name="newtags" type="text" class="form-control" id="post_tags" Placeholder="post tags" title="please leave a space between each tag" />
		<p> please leave a space between each tag </p> 
	</div>

	<button type="submit" class="btn btn-primary">create post</button>
</form>
@endsection