@extends('layouts.app')


@section('content')


<div class="container pt-2" style="max-width: 830px; ">
	  <div class="row post-show" data-id="{{$post->id}}">
	  	<div class="col-md-6 col-12" style="padding-left: 0;padding-right: 0">
	  		 <img src="{{asset($post->img)}}" class="w-100 h-100">
	  	</div>
	  	<div class="col-md-6 col-12" style="padding-left: 0;padding-right: 0;">
	  		<div class="card">
	  				<div class="card-title ">

	  					<img src="{{asset($post->user->img)}}" class="rounded-circle p-2" style="width: 60px;height: 60px">
	  					<h4 class="d-inline ml-1">{{$post->user->username}}</h4>

            <div class="ml-3 d-inline">

      @can('myAccount',$post->user)
               <div class=" d-inline float-right">
                   <span  class="buttonSettingPost">
                     ...
                   </span>
               </div>

               <div class="clearfix"></div>

      @else
              <div class="d-inline">

                @if(auth()->user())

                     <?php 
                          $status = in_array($post->user->id,user()->following->pluck('id')->toArray()) ? true : false;
                     ?>

                     <button class="btn btn-primary foll_unfol" data-id="{{ $status ? 'yes' : 'no' }}" data-profile_id="{{$post->user->id}}">
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

	  					<hr>
	  				</div>
	  			<div class="card-body pt-0 to-card-body">

	  				<div class="row " >

	  				 <img src="{{asset($post->user->img)}}" class="col-2 rounded-circle p-2" style="width: 60px; height: 60px;">
	  				 <div class="col-10" style="">
	  				  	<div class="pt-2">
	  				  		 <strong>{{$post->user->username}}</strong>
		  				     <span>{{$post->caption}}</span>

	  				  	</div>

	  				  </div>
	  				</div>

	  	<!--  ------------------------------------------------ -->
	  	<div class="comments">
             @if($post->comments->count() > 0)
              @foreach($post->comments as $comments)
             <div class="row comment-{{$comments->pivot->id}}" style="border-top: 1px solid rgba(0, 0, 0, 0.1">	  				
               <img src="{{asset($comments->img)}}" class="col-2 rounded-circle p-2" style="width: 60px; height: 60px;" >
	  				 <div class="col-8" >
	  				  	<div class="pt-2">
	  				  		 <strong>
                      <a href="{{route('profile',$comments->username)}}" style="color: #333;text-decoration: none;"> {{$comments->username}}</a>
                    </strong>
		  				     <span class="comment_value">{!! nl2br($comments->pivot->comment) !!}</span>

	  				  	</div>

	  				  </div>
	  				  <div class="col-2 row pt-1 seting">
	  				  		<i class="fa fa-heart-o " style="position: relative;top: 7px;"></i>
	  				  	 @if($post->user->id == user()->id)	
	  				  	     <span  class="show_setting" data-toggle="modal" data-comment_id="{{$comments->pivot->id}}">
								  ...
						    </span>

	  				  	 @elseif($comments->pivot->user_id == user()->id)

                            <span  class="show_setting" data-toggle="modal" data-comment_id="{{$comments->pivot->id}}" >
								  ...
						    </span>
                            
	  				  	 @endif
	  				  	
	  				  </div>
             </div> 
               @endforeach
		  	@endif
	  	</div>
      </div>
   <?php
        $like = $post->likes->where('user_id',user()->id)->first();

    ?> 
	  			<div class="card-footer" style="background: #FFF">
	  				<span>
                 <i  class="fa {{$like  ? 'fa-heart' : 'fa-heart-o'}} mr-1 like_unlike_post" data-status="{{$like  ? 'like' : 'unlike'}}" style="font-size: 1.8em;"></i>
	  				</span>
	 				<span>
	  					<i class="fa fa-comment-o  mr-1 comment_focus" style="font-size: 1.8em;"></i>
	  				</span>
	 	  			<span>
	  					<i class="fa fa-share  mr-1 " style="font-size: 1.8em;"></i>
	  				</span>
	  				<div>
	  					liked by <span class="count_like">{{$post->likes->count()}}</span>
	  				</div>
	  		    </div>
	  		    <div class="card-footer " style="background: #FFF; padding: 3px 6px 3px 15px;">
                   <div class="row">
  

                     <textarea class="col-9 comment" rows="2" style="border: none;outline: 0; resize: none;" placeholder="Add comment">
                     	
                     </textarea>

                       <div class="col-3">
                     	<button class="btn btn-secondary disabled topost mt-1" style="cursor: unset; ">Post</button></div>
                    </div>

	  		    </div>
	  		</div>
	  	</div>
	  </div>
</div>





<!-- Small modal -->


<!-- ----------------to comment ------------------------------ -->



<div class="modal fade " id="showSettng"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-body text-center">
         	<div class="mt-2 mb-2">
         		<button class="btn btn-danger buton-delete " data-toggle="modal"> 
         	     delete
         	   </button>
         	   <br>
                <i class="fas fa-spinner fa-spin deleteLoading d-none mt-1"></i>

           </div>
         	 <hr> 
         	
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

      </div>

    </div>
  </div>
</div>


   <!-- ----------------modal to post ------------------------------ -->

    <div class="modal fade " id="showSettngPost"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <div class="modal-body text-center">
              <div class="mt-2 mb-2">
                <a  href="{{route('post.edit',$post->id)}}" class="btn btn-secondary  "> 
                   edit
                 </a>
                 <br>
                 <hr> 
                         <form method="post" action="{{route('post.destroy',$post->id)}}">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="btn btn-danger">delete</button>
                          
                         </form>

          
               </div>
               <hr> 
              
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

          </div>

        </div>
      </div>
    </div>



@endsection