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
	public static function splitNewTags($tagsString)
	{
		$counter = 0;
	
		$t = Tag::insert_tags($tagsString);
    
        foreach ($t as $key) 
        {
            $newtags_array[$counter++] = $key->name;
        }
    
        return $newtags_array;
	}
	public static function mergeAndUnique($firstArray , $secondArray)
	{
		if($firstArray == null)

			$firstArray = [];

		if($secondArray == null)
		
			$secondArray = [];

		$merge = array_merge($firstArray , $secondArray);

		$unique = array_unique($merge);

		return $unique;
	}
	public static function insert($tags,$post)
	{
		foreach ($tags as $tag) 
        {
            \App\post_tag::create(['post_id' => $post->id , 'tag_id' => Tag::where('name' , $tag)->pluck('id')[0]]);
        }
	}
	public static function insertTagsAndPostToPivotTable($tags = null , $newtags = null , $post)
	{
		if($newtags != null)

			$newtags = static::splitNewTags($newtags);

		$tags = static::mergeAndUnique($tags , $newtags);

		static::insert($tags,$post);
	}	
}
