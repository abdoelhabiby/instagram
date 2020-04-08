<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

use App\Post;
use App\User;

use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{

//--------------------------------------------------------
    public function index(User $user)
    {    
        
       $allPosts = $user->posts()->latest()->paginate(9);


            $countPost =  $user->posts->count();
            $following =  $user->following()->orderBy('id','asc')->limit(10)->get();
            $followers =  $user->followers()->orderBy('id','asc')->limit(10)->get();
           
           


        return view('profile.index',compact(['user','allPosts','countPost','followers','following']));
    }
//--------------------------------------------------------


        public function getfollowing(){

            if(request()->ajax() && request()->lastId && request()->username){

                 $user = User::where("username",request()->username)->first();

                 if($user != null){
                   $id = (int)request()->lastId;
                     
                $following =  $user->following()->where('profile_id','>',$id)->orderBy('id','asc')->limit(10)->get();

                if($following->count() > 0){

                    $html =  view('profile._following',compact(['user','following']))->render();

                 return response(['data' => $html]);

                   }else{

                     return response(['data' => 'null']);
                   }

                 }


            } //end if request is ajax






        }



//--------------------------------------------------------



    public function getfollowers(){

            if(request()->ajax() && request()->lastId && request()->username){

                 $user = User::where("username",request()->username)->first();

                 if($user != null){
                   $id = (int)request()->lastId;
                     
                $followers =  $user->followers()->where('user_id','>',$id)->orderBy('id','asc')->limit(10)->get();

           

                if($followers->count() > 0){

                    $html =  view('profile._followers',compact(['user','followers']))->render();

                 return response(['data' => $html]);

                   }else{

                     return response(['data' => 'null']);
                   }


                 }


            } //end if request is ajax






        }
//--------------------------------------------------------

 public function edit(){
 	  return view('profile.edit');
 }


//--------------------------------------------------------

 public function update(){

     $validate = request()->validate([
 
			"name"  => "required|string" ,
			"username"  => "required|string",
			"email"  => "required|email",
			"description"  => "string|sometimes|nullable",
			"url"  => "sometimes|nullable|url",
			"img" => "image|mimes:jpeg,jpg,png,gif|max:10000",

     ]);

     if(request()->hasFile('img')){

      
      if(auth()->user()->img != null && auth()->user()->img != 'images/profile/default.png'){
         
        if(file_exists(public_path(auth()->user()->img))){

        	unlink(public_path(auth()->user()->img));
        }
      }

        $file = request()->file('img');

        $name = 'images/profile/' . $file->hashName();
        $img = Image::make($file);
        $img->resize(350,300,function($ratio){
            $ratio->aspectRatio();
 
        });
         $img->save(public_path($name));
        
     	$validate['img'] = $name; 
     }


     auth()->user()->update($validate);

     return back();

 }


//--------------------------------------------------------



}
