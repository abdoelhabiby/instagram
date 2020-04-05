@extends('layouts.app')




@section('content')
<div class="container d-flex justify-content-center">

    <div class="row ">

        <div class="col-3 pt-3 pl-0" style="height: 200px !important;width: 215px !important;">
            <img alt="{{$user->username}} profile picture" class="_6q-tv rounded-circle" src="{{$user->img}}">
        </div>

        <div class="col-9 pt-4 pl-3">
            <div class="row">
               <div class="col-sm-4">
                  <h2 class="font-weight-bold d-inline">{{$user->username}}</h2>

               </div>


      @can('myAccount',$user)
               <div class="col-sm-4">
                   <a href="{{route('profile.edit')}}" class="btn btn-secondary " style="color: #FFF">Edit Profile</a>
               </div>

               <div class="col-sm-4 pt-2">
                <a href="{{route('post.create')}}">
                  <i class="fa fa-lg fa-plus-circle" style="color:#3490dc;"></i>
                  Add new Post
                </a>
               </div>
      @else
              <div class="col">

                @if(auth()->user())

                     <?php 
                          $status = in_array($user->id,user()->following->pluck('id')->toArray()) ? true : false;
                     ?>

                     <button class="btn btn-primary foll_unfol" data-id="{{ $status ? 'yes' : 'no' }}" data-profile_id="{{$user->id}}">
                     {{ $status ? 'Following' : 'Follow' }}
                     </button>
                    <i class="fas fa-sync fa-spin loadingSpin fa-1x d-none ml-2"></i>

                @else
                     <button class="btn btn-primary">
                            <a href="{{route('login')}}" style="color: #FFF;text-decoration: none;">Follow</a>
                     </button>


                @endif 

               </div>

               

      @endcan
            </div>
            <div class="d-flex pt-4">
                <div>
                    <span class="mr-5">

                      <strong>{!!$countPost!!} </strong>posts
                    </span>
                    <span class="mr-5">
                      <strong class="change_count_followers">
                        {{$user->followers->count()}} 
                      </strong>
                       @if($user->followers->count() > 0)
                        <span class="font-weight-bold" style="cursor: pointer;" data-toggle="modal" data-target="#showFollowers">
                          followers
                        </span> 
                        @else
                        followers
                        @endif
                    </span>
                    <span class="mr-5">

                      <strong class="change_count_following">
                        {{$user->following->count()}}
                      </strong> 
                       @if($user->following->count() > 0)
                        <span class="font-weight-bold modalShow" style="cursor: pointer;" data-toggle="modal" data-target="#showFolloweing">
                          following
                        </span> 
                        @else
                         following
                        @endif

                    </span>
                </div>
            </div>
            <div class="pt-4">

               <h4 class="font-weight-bold">{{$user->name}}</h4>
               <p>{!! $user->description !!}</p>
               <div><a href="{{$user->url}}" target="_tblanck"><strong>{{$user->url}}</strong></a></div>

            </div>
        </div>

    </div>


</div><!-- end of container -->

<div class="container" style="max-width: 982px;">

  <hr>

    @if($allPosts->total() > 0)
  <div class="row">

      @foreach($allPosts as $post)
          <div class="col-lg-4 col-md-6 col-sm-12" >
              <div class="imgs-body">
               <a href="{{route('post.show',$post->id)}}">

                  <div class="overlay">
                    <i class="fa fa-lg  fa-heart mr-3" style="color:#FFF"> {{$post->likes()->get()->count()}}
                    </i>
                    <i class="fa  fa-lg fa-comment" style="color:#FFF"> 
                      {{$post->comments()->get()->count()}}
                    </i>
                  </div>

                  <div class="img-fix ">
                        <img src="{{asset($post->img)}}" >

                  </div>
              </a>

               </div>
          </div>

      @endforeach
   </div>

    @endif


            <div class="d-flex justify-content-center mt-5">

            {{ $allPosts->appends(request()->query())->links() }}

             </div>

  </div>


<!-- ------------------------------------------------------ -->


@if($user->followers->count() > 0)
  <div class="modal fade" id="showFollowers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Following</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body " style="max-height: 350px;overflow: auto;">

       @foreach($user->followers as $profile)   
           <div class="row showFollowersModal" data-id="{{$profile->id}}">
              <div class="col-9">
                <img src="{{asset($profile->img)}}" class="rounded-circle p-2" style="width: 60px;height: 60px">
                <h5 class="d-inline ml-1">
                  <a href="/{{$profile->username}}"  style="font-weight: bold;color: #333;text-decoration: none;">
                    {{$profile->username}}
                  </a>  
                </h5> 
             </div>  
             <div class="col-3 text-center">
              @if(user())
                @if($user->username == user()->username)

                <?php 
                      $status = in_array($profile->id, user()->following->pluck('id')->toArray()) ? true : false;
                 ?>
                <button class="btn btn-primary mt-2" id="modal-follow-unfollow" data-status="{{$status ? 'following' : 'follow'}}" data-profile="true">
                    <span class="textButton ">{{$status ? 'Following' : 'Follow'}}</span>
                    <i class="fas fa-sync fa-spin loadingFollow fa-1x d-none"></i>
                </button>

                @else

                <?php 
                      $status = in_array($profile->id, user()->following->pluck('id')->toArray()) ? true : false;
                 ?>
                <button class="btn btn-primary mt-2" id="modal-follow-unfollow" data-status="{{$status ? 'following' : 'follow'}}">
                    <span class="textButton ">{{$status ? 'Following' : 'Follow'}}</span>
                    <i class="fas fa-sync fa-spin loadingFollow fa-1x d-none"></i>
                </button>

                @endif   

                @else
                     <button class="btn btn-primary">
                            <a href="{{route('login')}}" style="color: #FFF;text-decoration: none;">Follow</a>
                     </button>


                @endif  


            </div>          
          </div>      
       @endforeach         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endif
<!-- ----------------------following------------------------------ -->


@if($user->following->count() > 0)
  <div class="modal fade" id="showFolloweing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Following</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body " style="max-height: 350px;overflow: auto;">

       @foreach($user->following as $profile)   
           <div class="row showFolloweingModal" data-id="{{$profile->id}}">
              <div class="col-9">
                <img src="{{asset($profile->img)}}" class="rounded-circle p-2" style="width: 60px;height: 60px">
                <h5 class="d-inline ml-1">
                  <a href="/{{$profile->username}}"  style="font-weight: bold;color: #333;text-decoration: none;">
                    {{$profile->username}}
                  </a>  
                </h5> 
             </div>  
             <div class="col-3 text-center">
              @if(user())
                @if($user->username == user()->username)

               <button class="btn btn-primary mt-2" id="modal-unfollow">
                   
                      <span class="textButton">Following</span>

                      <i class="fas fa-sync fa-spin loadingFollow fa-1x d-none"></i>

                  </button>
                @else

                <?php 
                      $status = in_array($profile->id, user()->following->pluck('id')->toArray()) ? true : false;
                 ?>
                <button class="btn btn-primary mt-2" id="modal-follow-unfollow" data-status="{{$status ? 'following' : 'follow'}}">
                    <span class="textButton ">{{$status ? 'Following' : 'Follow'}}</span>
                    <i class="fas fa-sync fa-spin loadingFollow fa-1x d-none"></i>
                </button>

                @endif   

                @else
                     <button class="btn btn-primary mt-2">
                            <a href="{{route('login')}}" style="color: #FFF;text-decoration: none;">Follow</a>
                     </button>


                @endif  


            </div>          
          </div>      
       @endforeach         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endif

@endsection

@push('scripts')

<script type="text/javascript">
  $(function(){
     var token = $('meta[name="csrf-token"]').attr('content');
     var login = "/login";


  $(document).on('click',"#modal-unfollow",function(){
    var modaldelete = $(this).closest(".modal .showFolloweingModal");
    var profileId = $(modaldelete).data("id");
    var textButton = $(modaldelete).find(".textButton");
    var loading = $(modaldelete).find(".loadingFollow");

                $.ajax({
                   url:"/user/unfollow",
                   method:'post',
                   datatype:'json',
                   data:{_token:token,profile_id:profileId},
                   beforeSend:function(){
                         $(textButton).addClass("d-none");
                         $(loading).removeClass("d-none");
                   },
                   success:function(data){

                     $(loading).addClass("d-none"); 
                     $(modaldelete).remove();
                  if($.isNumeric($('.change_count_following').text())){
                       var getcount = parseInt($('.change_count_following').text() ) - 1 ;
                       $('.change_count_following').text(getcount);
                         
                         if(getcount == 0){
                           $('.modalShow').attr('data-target','');
                           $("#showFolloweing").modal('hide');
                         }

                     }
                   },
                   error:function(data){
                     if(data.status == 401){
                        window.location.href = login;
                     }
                   }
               });

}); 

//---------------------------------------------------------------------

     $(document).on('click',"#modal-follow-unfollow",function(){
         
         var profileId = $(this).closest(".modal .showFolloweingModal").data("id");
         var loading = $(this).closest(".modal .showFolloweingModal").find(".loadingFollow");
         var textButton = $(this).closest(".modal .showFolloweingModal").find(".textButton");
         var status = $(this).closest(".modal .showFolloweingModal").find("#modal-follow-unfollow");


            
            if(status.attr('data-status') == 'following'){  //sen request to unfollow
               
              


                 $.ajax({

                   url:"/user/unfollow",
                   method:'post',
                   datatype:'json',
                   data:{_token:token,profile_id:profileId},
                   beforeSend:function(){
                         $(textButton).addClass("d-none");
                         $(loading).removeClass("d-none");
                   },
                   success:function(data){

                     $(loading).addClass("d-none"); 
                     $(textButton).removeClass("d-none").text('Follow');

                     status.attr('data-status','follow') 

                    
                   },
                   error:function(data){

                     if(data.status == 401){

                        window.location.href = login;
                     }

                     status.attr('data-status','following');
                     $(textButton).removeClass("d-none").text('Following');
                     $(loading).addClass("d-none"); 
                   }
                
               });

            }  // end if status == following
           
  //----------------------------------------------------------

              if(status.attr('data-status') == 'follow'){  //sen request to follow
             
                

                  
                 $.ajax({

                   url:"/user/follow",
                   method:'post',
                   datatype:'json',
                   data:{_token:token,profile_id:profileId},
                   beforeSend:function(){
                         $(textButton).addClass("d-none");
                         $(loading).removeClass("d-none");
                   },
                   success:function(data){

                     $(loading).addClass("d-none"); 
                     $(textButton).removeClass("d-none").text('Following');

                     status.attr('data-status','following') 

                    
                   },
                   error:function(data){

                     if(data.status == 401){

                        window.location.href = login;
                     }
                     $(loading).addClass("d-none"); 
                     $(status).attr('data-status','follow');
                     $(textButton).removeClass("d-none").text('Follow');

                   }
                
               });

            }  // end if status == following


     }); // end button follow unfollow

//----------------------------------------------------

   $(document).on('click',"#modal-follow-unfollow",function(){
         
         var profileId = $(this).closest(".modal .showFollowersModal").data("id");
         var loading = $(this).closest(".modal .showFollowersModal").find(".loadingFollow");
         var textButton = $(this).closest(".modal .showFollowersModal").find(".textButton");
         var status = $(this).closest(".modal .showFollowersModal").find("#modal-follow-unfollow");
         var statusProfile = $(this).closest(".modal .showFollowersModal").find("#modal-follow-unfollow");


         
            
            if(status.attr('data-status') == 'following'){  //sen request to unfollow
               
              


                 $.ajax({

                   url:"/user/unfollow",
                   method:'post',
                   datatype:'json',
                   data:{_token:token,profile_id:profileId},
                   beforeSend:function(){
                         $(textButton).addClass("d-none");
                         $(loading).removeClass("d-none");
                   },
                   success:function(data){

                     $(loading).addClass("d-none"); 
                     $(textButton).removeClass("d-none").text('Follow');

                     status.attr('data-status','follow') 

                     if(statusProfile.attr('data-profile') == 'true'){

                      if($.isNumeric($('.change_count_following').text())){
                           var getcount = parseInt($('.change_count_following').text() ) - 1 ;
                           $('.change_count_following').text(getcount);
                             
                             if(getcount == 0){
                               $('.modalShow').attr('data-target','');
                               $("#showFolloweing").modal('hide');
                             }

                         }

                     }

                    
                   },
                   error:function(data){

                     if(data.status == 401){

                        window.location.href = login;
                     }

                     status.attr('data-status','following');
                     $(textButton).removeClass("d-none").text('Following');
                     $(loading).addClass("d-none"); 
                   }
                
               });

            }  // end if status == following
           
  //----------------------------------------------------------

              if(status.attr('data-status') == 'follow'){  //sen request to follow
             
                

                  
                 $.ajax({

                   url:"/user/follow",
                   method:'post',
                   datatype:'json',
                   data:{_token:token,profile_id:profileId},
                   beforeSend:function(){
                         $(textButton).addClass("d-none");
                         $(loading).removeClass("d-none");
                   },
                   success:function(data){

                     $(loading).addClass("d-none"); 
                     $(textButton).removeClass("d-none").text('Following');

                     status.attr('data-status','following') 
                   if(statusProfile.attr('data-profile') == 'true'){

                      if($.isNumeric($('.change_count_following').text())){
                           var getcount = parseInt($('.change_count_following').text() ) + 1 ;
                           $('.change_count_following').text(getcount);

                         }
                       }  

                    
                   },
                   error:function(data){

                     if(data.status == 401){

                        window.location.href = login;
                     }
                     $(loading).addClass("d-none"); 
                     $(status).attr('data-status','follow');
                     $(textButton).removeClass("d-none").text('Follow');

                   }
                
               });

            }  // end if status == following


     }); // end button follow unfollow



//---------------------------------------------------

  });
</script>




@endpush

