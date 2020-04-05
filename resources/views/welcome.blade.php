@extends('layouts.app')


@section('content')

    @if($getPosts->count() > 0)


         <div class="container"  style="max-width: 500px; margin: auto;">
        
        @foreach($getPosts as $allPosts)

            <div class="card mb-4" data-id ="{{$allPosts->id}}">
                 <div class="card-header " style="background: #FFF;">

                 <div class="row">
                  <div class="col-10 pl-0">
                     <a href="{{route('profile',$allPosts->user->username)}}" style="color: #333; text-decoration: none;">
                           <img src="{{asset($allPosts->user->img)}}" style="width: 40px;height: 40px;" class="rounded-circle">
                           <div class="h5 d-inline font-weight-bold ml-2">
                             {{$allPosts->user->username}}  
                          </div>
                      </a>
                    </div>
                    <div class="col-2 pr-0">
                       <span class="showSetting" data-toggle="modal" data-target="#showSettngPost">   ...
                       </span>
                    </div>
                    </div> 
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
  

                     <textarea class="col-9 commentPost" rows="2" style="border: none;outline: 0; resize: none;" placeholder="Add comment">
                        
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



<!-- --------------------------------------------------- -->

<div class="modal fade " id="showSettngPost"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-body text-center">
          <div class="mt-2 mb-2">

           </div>
           <hr> 
          
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

      </div>

    </div>
  </div>
</div>




@endsection
