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
                  <h4 class="font-weight-bold d-inline">{{$user->username}}</h4>

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
              <div class="col ml-5" >

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
                        <span class="font-weight-bold modalShowFollowers" style="cursor: pointer;">
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
                        <span class="font-weight-bold modalShowFollowing" style="cursor: pointer;" >
                          following
                        </span> 
                        @else
                         following
                        @endif

                    </span>
                </div>
            </div>
            <div class="pt-4">

               <h5 class="font-weight-bold">{{$user->name}}</h5>
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


@if($followers->count() > 0)
  <div class="modal fade" id="showFollowers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-username="{{$user->username}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Followers</h5>
         <div class="text-center loadingLimitFollowers mt-1 d-none">
           <i class="fas fa-sync fa-spin  fa-1x  ml-2 "></i>
         </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body " style="max-height: 350px;overflow: auto;">

       @foreach($followers as $profile)   
           <div class="row showFollowersModal followers-row-{{$profile->id}}" data-id="{{$profile->id}}" id="{{$profile->id}}">
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

               @if($profile->username != user()->username)  
                <button class="btn btn-primary mt-2" id="modal-follow-unfollow" data-status="{{$status ? 'following' : 'follow'}}">
                    <span class="textButton ">{{$status ? 'Following' : 'Follow'}}</span>
                    <i class="fas fa-sync fa-spin loadingFollow fa-1x d-none"></i>
                </button>

               @endif 

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


@if($following->count() > 0)
  <div class="modal fade" 
  id="showFolloweing" data-username="{{$user->username}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true" >
  <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenter">Following</h5>
         <div class="text-center loadingLimitFollowing d-none mt-1">
           <i class="fas fa-sync fa-spin  fa-1x  ml-2 "></i>
         </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div  class="modal-body"  style="max-height: 350px;overflow: auto;">
 
       @foreach($following as $profile)   
           <div class="row showFolloweingModal followingRow-{{$profile->id}}" data-id="{{$profile->id}}" id="{{$profile->id}}">
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
               
                 @if($profile->username != user()->username)

                    <button class="btn btn-primary mt-2" id="modal-follow-unfollow" data-status="{{$status ? 'following' : 'follow'}}">
                        <span class="textButton ">{{$status ? 'Following' : 'Follow'}}</span>
                        <i class="fas fa-sync fa-spin loadingFollow fa-1x d-none"></i>
                    </button>
                  @endif  

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


