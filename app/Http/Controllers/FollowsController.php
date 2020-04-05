<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Follow;
use App\Post;
use App\Comment;
use App\Like;

use Validator;

class FollowsController extends Controller
{
   
   use ResponseTrait;

//-----------------------------------follow unfollow----------------------------   

   public function follow(){

   	  if(request()->ajax() && request()->profile_id){

   	  	$validate = Validator::make(request()->all(),['profile_id' => 'required|numeric']);

   	  	if($validate->fails()){
   	  		   	  	   return $this->notFound();
   	  	}
       
        $profile = User::find(request()->profile_id); 
        $profile_follow = Follow::where('user_id',user()->id)->where('profile_id',request()->profile_id)->first();
    
       if($profile != null && $profile_follow == null && $profile->id != user()->id){
       	  Follow::create(['user_id' => user()->id,'profile_id' => $profile->id]);
       	  return $this->responseStatus(null,null,'ok',200);

       }else{
   	  	   return $this->notFound();

       }

   	  }else{

   	  	   return $this->notFound();

   	  }

   }

//---------------------------------------------------------------------

 public function unfollow(){

   	  if(request()->ajax() && request()->profile_id){
       
        $profile = Follow::where('user_id',user()->id)->where('profile_id',request()->profile_id)->first();

        if($profile != null){

        	$profile->delete();
        	return $this->responseStatus(null,null,'ok',200);
        }else{
          return $this->notFound();
        }    
   	  }else{

   	  	   return $this->notFound();

   	  }

   }

//-------------------------like unlike --------------------------------------------------


   public function like(){

   	  if(request()->ajax() && request()->post_id){

   	  	$validate = Validator::make(request()->all(),['post_id' => 'required|numeric']);

   	  	if($validate->fails()){
   	  		  return $this->notFound();
   	  	}
       
        $post = Post::find(request()->post_id);

        $checkIfLiked = Like::where("post_id",$post->id)->where('user_id',user()->id)->first();

        if($checkIfLiked != null){
          return $this->responseStatus(null,"هعملك بلوك يا علق",'error',404);
        } 
    
       if($post != null ){
       	  Like::create(['user_id' => user()->id,'post_id' => $post->id]);
       	  return $this->responseStatus(null ,null,'ok',200);

       }else{
   	  	   return $this->notFound();

       }

   	  }else{

   	  	   return $this->notFound();

   	  }

   }

//---------------------------------------------------------------------

 public function unlike(){

   	  if(request()->ajax() && request()->post_id){


        $like = Like::where('user_id',user()->id)->where('post_id',request()->post_id)->first();


        if($like != null){

        	$like->delete();
        	return $this->responseStatus(null,null,'ok',200);
        }else{
          return $this->notFound();
        }    
   	  }else{

   	  	   return $this->notFound();

   	  }

   }













//---------------------------------------------------------------------------------------

}
