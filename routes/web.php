<?php
Auth::routes();

Route::get('/posts', "postscontroller@index");

Route::post('/posts', "postscontroller@store");

Route::get('/post/create','postscontroller@create');

Route::get('/logout','userscontroller@logout');

Route::get('/post/{id}','postscontroller@show');

Route::patch('/post/{id}','postscontroller@edit');

Route::put('/post/{id}','postscontroller@update');

Route::post('post/add-comment','commentscontroller@store');

Route::post('post/add-reply','repliesController@store');

Route::delete('/post/{id}','postscontroller@destroy');

Route::delete('/post/{id}/delete-comment','commentscontroller@destroy');

Route::delete('/post/{id}/delete-reply','repliesController@destroy');

Route::post('post/{id}/like-post','likesController@store');

Route::post('post/{id}/like-comment','likesController@store');

Route::post('post/{id}/like-reply','likesController@store');

Route::post('post/{id}/unlike-post','likesController@deletePostLike');

Route::post('post/{id}/unlike-comment','likesController@deleteCommentLike');

Route::post('post/{id}/unlike-reply','likesController@deleteReplyLike');

Route::post('post/{id}/post-likes','likesController@postLikes');

Route::post('post/{id}/comment-likes','likesController@commentLikes');

Route::post('post/{id}/reply-likes','likesController@replyLikes');



Route::get('/tags/{tag}','tagscontroller@show');





Route::get('/', function () {
    return redirect('posts');
});
