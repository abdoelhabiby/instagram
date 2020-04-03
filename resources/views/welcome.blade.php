@extends('layouts.app')

@push('scripts')

<script type="text/javascript">
    $(function(){
         
         $('body').on('click','.like_unlike',function(){

            
            var postId = $(this).closest('div.card').data('id');
            var countSpan = $(this).closest('div.card').find('.count_like');
            var likeStatus = $(this).attr('data-status');



             if(likeStatus == 'liked'){

                 
                        $(this).removeClass('fa-heart').addClass('fa-heart-o');
                       $(this).attr('data-status','like');



           $.ajax({   //send request to unlike

                   url:"{{route('unlike')}}",
                   method:'post',
                   datatype:'json',
                   data:{_token:"{{csrf_token()}}",post_id:postId},
                   beforeSend:function(){
                   },
                   success:function(data){
                     

                     if($.isNumeric($(countSpan).text())){
                        var getcount = parseInt($(countSpan).text() ) - 1 ;
                        $(countSpan).text(getcount);

                       }


                   },
                   error:function(data){

                     if(data.status == 401){

                        window.location.href = "{{route('login')}}";
                     }


                   }
                

               });

             } //end if status = unlike


             if(likeStatus == 'like'){

                        $(this).addClass('fa-heart').removeClass('fa-heart-o');

                        $(this).attr('data-status','liked');


                 $.ajax({  

                       url:"{{route('like')}}",
                       method:'post',
                       datatype:'json',
                       data:{_token:"{{csrf_token()}}",post_id:postId},
                       beforeSend:function(){
                       },
                       success:function(data){



                        if($.isNumeric($(countSpan).text())){
                            var getcount = parseInt($(countSpan).text() ) + 1 ;
                            $(countSpan).text(getcount);

                           }

                       },
                       error:function(data){

                         if(data.status == 401){

                            window.location.href = "{{route('login')}}";
                         }

                       }
                    
                   });


             } //end if status = like

         });




    });


</script>




@endpush


@section('content')

    @if($getPosts->count() > 0)


         <div class="container"  style="max-width: 500px; margin: auto;">
        
        @foreach($getPosts as $allPosts)

            <div class="card mb-4" data-id ="{{$allPosts->id}}">
                 <div class="card-header" style="background: #FFF;">
                     <a href="{{route('profile',$allPosts->user->username)}}" style="color: #333; text-decoration: none;">
                           <img src="{{asset($allPosts->user->img)}}" style="width: 40px;height: 40px;" class="rounded-circle">
                           <div class="h5 d-inline font-weight-bold ml-2">
                             {{$allPosts->user->username}}  
                          </div>
                      </a>
                   </div>
                <div class="card-body">
                              <div class="text-center mb-2">
                                <img src="{{asset($allPosts->img)}}" style="height: 370px; width: 90%">
                              </div> 
                </div>

    <!-- ---------------like and comment ----------------------------- -->

  <?php
      
      $user_like =  $allPosts->likes->where('user_id',user()->id)->first();
  ?>


                <div class="card-footer" style="background: #FFF;">
                        <span>
                         <i class="fa {{$user_like != null ? 'fa-heart' : 'fa-heart-o'}} mr-1 like_unlike" 
                         data-status="{{$user_like != null ? 'liked' : 'like'}}" 
                         style="font-size: 1.8em;" id="yes"></i>
                         </span>
                         <span>
                         <a href="{{route('post.show',$allPosts->id)}}" style="color: #333; text-decoration: none;">

                            <i class="fa fa-comment-o  mr-1" style="font-size: 1.8em;"></i>
                        </a>
                         </span>
                         <span>
                                <i class="fa fa-share  mr-1 " style="font-size: 1.8em;"></i>
                         </span>

                         <div class="countlikes">
                             <strong>Liked by </strong><span class="count_like">{{$allPosts->likes->count()}}</span>
                         </div>
                         <div class="captionAndComment">
                             <div class="caption">
                                <strong>{{$allPosts->user->username}} </strong>
                                <span class="pr-2">
                                    {{ $allPosts->caption}}
                                </span>
                                <br>
                              @if($allPosts->commentsDesc->count() > 3)  
                                <a href="{{route('post.show',$allPosts->id)}}" style="text-decoration: none;color: gray">
                                    view all {{$allPosts->comments->count()}} comments
                                </a>
                               @endif 
                             </div>
                             <div class="showLatestComment">


                               @if($allPosts->commentsDesc != null) 
                                @foreach($allPosts->commentsDesc()->limit(3)->latest()->get() as $comments)
                                 <div>
                                    <strong>
                                     <a href="{{route('profile',$comments->username)}}" style="color: #333; text-decoration: none;">

                                        {{$comments->username}} 
                                    </a>
                                    </strong>
                                    <span class="pr-2">
                                        {{ $comments->pivot->comment}}
                                    </span>
                                 </div>

                                @endforeach
                               @endif 

                             </div>
                         </div>
                </div>

    <!-- ---------------comment post ----------------------------- -->

                 <div class="card-footer " style="background: #FFF; padding: 3px 6px 3px 15px;">
                   <div class="row">
  

                     <textarea class="col-9 comment" rows="2" style="border: none;outline: 0; resize: none;" placeholder="Add comment">
                        
                     </textarea>

                       <div class="col-3">
                        <button class="btn btn-secondary disabled addComment mt-1" style="cursor: unset; ">Post</button></div>
                    </div>

                </div>
            </div>
         @endforeach   

            <div class="d-flex justify-content-center mt-5">

            {{ $getPosts->appends(request()->query())->links() }}

             </div>

        </div>

     @endif


@endsection

@push('scripts')

<script type="text/javascript">
    $(function(){
          
      $(document).on("keyup",'.comment',function(){

         if($(this).val().length > 0){

            $(this).closest("div.card").find('.addComment').removeClass('disabled');

         }else{
            $(this).closest("div.card").find('.addComment').addClass('disabled');
         }


      });


          //-------------------------------------------------

      $(document).on('click','.addComment',function(){

        var comment = $(this).closest("div.card").find(".comment");
        var appendComment = $(this).closest("div.card").find(".showLatestComment");
        var postId = $(this).closest("div.card").data('id');

          if(comment.val().length > 0){

                $.ajax({  
                   url:"{{route('commentIndex')}}",
                   method:'post',
                   datatype:'html',
                   data:{_token:"{{csrf_token()}}",post_id:postId,comment:comment.val()},
                   beforeSend:function(){

                      $(comment).val('');

                   },
                   success:function(data){

                    var username = data.data.username;
                    var comment = data.data.comment;
                  
                  var html =  ` <div>
                                    <strong>
                                     <a href="/${username}" style="color: #333; text-decoration: none;">

                                        ${username} 
                                    </a>
                                    </strong>
                                    <span class="pr-2">
                                        ${comment}
                                    </span>
                                 </div>`;


                      $(appendComment).append(html);


                   },
                   error:function(data){

                     if(data.status == 401){

                        window.location.href = "{{route('login')}}";
                     }

                   }
                
               }); //end ajax



          } // end if comment > 0


      });



    });
</script>

@endpush