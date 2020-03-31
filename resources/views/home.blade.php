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
                    <i class="fas fa-sync fa-spin fa-1x d-none ml-2"></i>

                @else
                     <button class="btn btn-primary">
                            Follow
                     </button>


                @endif 

               </div>

               

      @endcan
            </div>
            <div class="d-flex pt-4">
                <div>
                    <span class="mr-5">
                      <strong>{!!$user->posts->count()!!} </strong>posts
                    </span>
                    <span class="mr-5"><strong class="change_count">{{$user->followers->count()}} </strong> followers</span>
                    <span class="mr-5"><strong>{{$user->following->count()}} </strong> following</span>
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

    @if($user->posts->count() > 0)
  <div class="row">

      @foreach($user->posts as $post)
          <div class="col-lg-4 col-md-6 col-sm-12" >
              <div class="imgs-body">
               <a href="{{route('post.show',$post->id)}}">

                  <div class="overlay">
                    <i class="fa fa-lg  fa-heart mr-3" style="color:#FFF"> 55</i>
                    <i class="fa  fa-lg fa-comment" style="color:#FFF"> 56</i>
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




  </div>
@endsection
