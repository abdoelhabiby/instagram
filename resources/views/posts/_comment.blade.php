             <div class="row" style="border-top: 1px solid rgba(0, 0, 0, 0.1">	  				
               <img src="{{asset($comment->user->img)}}" class="col-2 rounded-circle p-2" style="width: 60px; height: 60px;">
	  				 <div class="col-10" >
	  				  	<div class="pt-2">
	  				  		 <strong>{{$comment->user->username}}</strong>
		  				     <span>{!! nl2br($comment->comment)!!}</span>

	  				  	</div>

	  				  </div>
             </div>