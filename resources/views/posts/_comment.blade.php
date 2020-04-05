 
<!-- ------------------------------------------------------------------- -->
           <div class="row comment-{{$comment->id}}" style="border-top: 1px solid rgba(0, 0, 0, 0.1">	  				
               <img src="{{asset($comment->user->img)}}" class="col-2 rounded-circle p-2" style="width: 60px; height: 60px;">
	  				 <div class="col-8" >
	  				  	<div class="pt-2">
	  				  		 <strong>
	  				  		 	<a href="{{route('profile',$comment->user->username)}}" style="color: #333;text-decoration: none;">
	  				  		 	{{$comment->user->username}}
	  				  		 </a>
	  				  		 </strong>
		  				     <span class="comment_value">{!! nl2br($comment->comment) !!}</span>

	  				  	</div>

	  				  </div>
	  				  <div class="col-2 row pt-1 seting">
	  				  		<i class="fa fa-heart-o " style="position: relative;top: 7px;"></i>


                            <span  class="show_setting" data-toggle="modal" data-comment_id="{{$comment->id}}" >
								  ...
						    </span>
                            
	  				  	
	  				  </div>
             </div>