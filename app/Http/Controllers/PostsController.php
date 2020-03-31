<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

//---------------------------------------------------------------------



    public function create()
    {
        return view('posts.create');
    }

//---------------------------------------------------------------------


    public function store(Request $request)
    {

       $validate = $request->validate([
         
         "img" => 'required|image|mimes:jpeg,jpg,png,gif|max:10000',
         'caption' => 'sometimes|nullable|string',

       ]);

       
        $file = $request->file('img');

        $name = $file->hashName();
        $img = Image::make($file);
        $img->resize(450,450,function($ratio){
            $ratio->aspectRatio();
        });

        $img->save(public_path('images/posts/'.$name));

        $validate['img'] = 'images/posts/'.$name;
        $validate['user_id'] = auth()->user()->id;

        Post::create($validate);

        $url = auth()->user()->username;


        return redirect("/".$url);

    }


 //---------------------------------------------------------------------


    public function show(post $post)
    {

       //return dd($post->comments);

        return view('posts.show',compact('post'));
    }

//---------------------------------------------------------------------


    public function edit(post $post)
    {
        //
    }

//---------------------------------------------------------------------


    public function update(Request $request, post $post)
    {
        //
    }

//---------------------------------------------------------------------


    public function destroy(post $post)
    {
        //
    }
}
