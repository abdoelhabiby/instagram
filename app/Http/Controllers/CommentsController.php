<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

use Validator;

use App\Http\Resources\CommentCollection;


class CommentsController extends Controller
{
  
   use ResponseTrait;

//----------------------------------------------------------

    public function store(Request $request)
    {
         
    if(request()->ajax() && request()->post_id && request()->comment){

        $validate = Validator::make(request()->all(),[
            'post_id' => 'required|numeric',
            'comment' => 'required|string|min:1'
        ]);

        if($validate->fails()){
          return $this->responseStatus(null ,null,'false',404);
        }
       

        $post = Post::find(request()->post_id); 
    
       if($post != null ){
        $comment = Comment::create([
            'user_id' => user()->id,
            'post_id' => $post->id,
            'comment' => request()->comment
        ]);
         
         $html = view('posts._comment',compact('comment'))->render();
         
          return $this->responseStatus($html ,null,'ok',200);

       }else{
           return $this->notFound();

       }

      }else{

           return $this->notFound();

      }


    }


//----------------------------------------------------------


    public function update(Request $request, Comment $comment)
    {
        //
    }

//----------------------------------------------------------


    public function destroy(Comment $comment)
    {
        //
    }


}
