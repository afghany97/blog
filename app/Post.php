<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class Post extends Model
{
    protected $table = "posts";
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function like()
    {
        return $this->hasMany(Like::class);
    }
    public function reply()
    {
        return $this->hasMany(Reply::class);
    }
    public static function archives()
    {
       return static::selectRaw('year(created_at) as year , monthname(created_at) as month , COUNT(*) as published')
       ->groupBy('year' , 'month')
       ->orderByRaw('min(created_at) desc')
       ->get();
    }
    public function scopeFilter($query , $filters)
    {
        if($month = $filters['month'])
        {
            $query->whereMonth('created_at',Carbon::parse($month)->month);
        }
        if($year = $filters['year'])
        {
            $query->whereYear('created_at',$year);
        }
    }

}
