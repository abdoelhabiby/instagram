<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    

    protected $table = 'posts';

    protected $fillable = [
        "user_id",
		"img",
		"caption",

    ];


    public function user(){

    	return $this->belongsTo(User::class);
    }

  
    public function likes(){

    	 return $this->hasMany(Like::class,'post_id');
    }


    public function comments(){

         return $this->belongsToMany(User::class,'comments')->withPivot(['comment','id'])->orderBy('pivot_id','asc');
    }


    public function commentsDesc(){

         return $this->belongsToMany(User::class,'comments')->withPivot(['comment','id'])->orderBy('pivot_id','desc');
    }





}
