<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
	public function posts()
	{
		return $this->belongsToMany(Post::class);
	}
	public static function insert_tags($tags)
	{
		$tags = explode(" " , $tags);
		$result_array = [];
		$counter = 0;
		foreach ($tags as $tag) 
		{
			if(!Tag::where('name' , $tag)->exists())
			{
				$result_array[$counter++] = Tag::create(['name' => $tag]);
			}
		}
		return $result_array;
	}	
}
