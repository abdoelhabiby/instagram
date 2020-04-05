<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

use App\Http\Resources\CommentCollection;

class PostsController extends Controller
{

//---------------------------------------------------------------------



    public function index()
    {
        $followingProfile = user()->following->pluck('pivot.profile_id');

        $followingPosts = Post::with('user')->whereIn('user_id',$followingProfile)->latest()->paginate(5);

  
       $getPosts = CommentCollection::collection($followingPosts);


       
        return view('welcome',compact('getPosts'));
    }

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
        $validate['user_id'] = user()->id;

        Post::create($validate);

        $url = user()->username;


        return redirect("/".$url);

    }


 //---------------------------------------------------------------------


    public function show(post $post)
    {


        return view('posts.show',compact('post'));
    }

//---------------------------------------------------------------------


    public function edit(post $post)
    {
          if($post->user_id == user()->id){
                return view('posts.edit',compact('post'));
             }else{
                abort(404);
             }

    }

//---------------------------------------------------------------------


    public function update(Request $request, post $post)
    {
            if($post->user_id == user()->id){
               
               $validate = $request->validate([
                   
                   "caption" => 'required|string|min:1'
               ]);

               $post->update($validate);

               return redirect(route('post.show',$post->id));
                

             }else{
                abort(404);
             }
    }

//---------------------------------------------------------------------


    public function destroy(post $post)
    {
            if($post->user_id == user()->id){

               $post->delete();

                $url = auth()->user()->username;


                return redirect("/".$url);
               
             }else{
                abort(404);
             }
    }
}
