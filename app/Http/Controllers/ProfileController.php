<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

use App\Post;
use App\User;

class ProfileController extends Controller
{

//--------------------------------------------------------
    public function index(User $user)
    {    
        return view('home',compact('user'));
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
