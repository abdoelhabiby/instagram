@extends('layouts.app')


@push('scripts')


<script type="text/javascript">
  $(function(){

    $(document).on('click','.like_unlike',function(){
      var postId = "{{$post->id}}";
      var status = $(this).attr('data-status');
   
        
        if (status == 'like') {


                $.ajax({   //send request to unlike

                   url:"{{route('unlike')}}",
                   method:'post',
                   datatype:'json',
                   data:{_token:"{{csrf_token()}}",post_id:postId},
                   beforeSend:function(){
                     $(".fa-sync").removeClass('d-none');
                   },
                   success:function(data){
                     
		             $(".like_unlike").removeClass('fa-heart').addClass('fa-heart-o');
		             $(".like_unlike").attr('data-status','unlike');

		             if($.isNumeric($('.count_like').text())){
		                var getcount = parseInt($('.count_like').text() ) - 1 ;
		                $('.count_like').text(getcount);

		               }


                   },
                   error:function(data){

                     if(data.status == 401){

                        window.location.href = "{{route('login')}}";
                     }


                   }
                

               });

        }


        if(status == 'unlike'){  //send request to like

         $.ajax({  

           url:"{{route('like')}}",
           method:'post',
           datatype:'json',
           data:{_token:"{{csrf_token()}}",post_id:postId},
           beforeSend:function(){
           },
           success:function(data){


             $(".like_unlike").removeClass('fa-heart-o').addClass('fa-heart');
		       $(".like_unlike").attr('data-status','like');

            if($.isNumeric($('.count_like').text())){
                var getcount = parseInt($('.count_like').text() ) + 1 ;
                $('.count_like').text(getcount);

               }

           },
           error:function(data){

             if(data.status == 401){

                window.location.href = "{{route('login')}}";
             }

           }
        
       });

        } // end else
    

    });
//-------------------------------------------------------------------

$(".comment_focus").click(function(){
   
   $(".comment").focus();

});
//-------------------------------------------------------------------
$(".comment").keyup(function(){
    

   if($(this).val().length > 0){

   $(".topost").removeClass('disabled');
   }else{
   	   $(".topost").addClass('disabled');

   }
   
});

//-------------------------------------------------------------------

 $(".topost").click(function(){
     
     if(! $(this).hasClass('disabled')){
          var postId = "{{$post->id}}";
          var user_comment = $(".comment").val();
        
        if(user_comment.length > 0){

		        $.ajax({  
		           url:"{{route('comment')}}",
		           method:'post',
		           datatype:'html',
		           data:{_token:"{{csrf_token()}}",post_id:postId,comment:user_comment},
		           beforeSend:function(){

		           	  $(".comment").val('');

		           },
		           success:function(data){


		           $(".comments").append(data.data);

		           },
		           error:function(data){

		             if(data.status == 401){

		                window.location.href = "{{route('login')}}";
		             }

		           }
		        
		       }); //end ajax

       }


     }

 });




//-------------------------------------------------------------------


  }); // end  open jquery
</script>



@endpush






@section('content')




<div class="container pt-2" style="max-width: 830px; ">
	  <div class="row" >
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
                   <a href="" class="btn btn-secondary " style="color: #FFF; margin: 13px;">...</a>
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
	  			<div class="card-body pt-0" style=" margin-top: -23px !important;max-height: 320px; overflow: auto; min-height: 320px">

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
             <div class="row" style="border-top: 1px solid rgba(0, 0, 0, 0.1">	  				
               <img src="{{asset($comments->img)}}" class="col-2 rounded-circle p-2" style="width: 60px; height: 60px;" >
	  				 <div class="col-10" >
	  				  	<div class="pt-2">
	  				  		 <strong>{{$comments->username}}</strong>
		  				     <span>{!! nl2br($comments->pivot->comment) !!}</span>

	  				  	</div>

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
                 <i class="fa {{$like  ? 'fa-heart' : 'fa-heart-o'}} mr-1 like_unlike" data-status="{{$like  ? 'like' : 'unlike'}}" style="font-size: 1.8em;"></i>
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


@endsection