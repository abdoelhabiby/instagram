$(function(){

     var token = $('meta[name="csrf-token"]').attr('content');
     var login = "/login";




//------------------- file blade show like and unlike  ----------------------

  $(document).on('click','.like_unlike_post',function(){
      var postId = $(this).closest("div.post-show").attr("data-id");
      var status = $(this).attr('data-status');
    

        if (status == 'like') {


                $.ajax({   //send request to unlike

                   url:"/user/unlike",
                   method:'post',
                   datatype:'json',
                   data:{_token:token,post_id:postId},
                   beforeSend:function(){
                   },
                   success:function(data){
                     
		             $(".like_unlike_post").removeClass('fa-heart').addClass('fa-heart-o');
		             $(".like_unlike_post").attr('data-status','unlike');

		             if($.isNumeric($('.count_like').text())){
		                var getcount = parseInt($('.count_like').text() ) - 1 ;
		                $('.count_like').text(getcount);

		               }


                   },
                   error:function(data){

                     if(data.status == 401){

                        window.location.href = login;
                     }


                   }
                

               });

        }


        if(status == 'unlike'){  //send request to like

         $.ajax({  

           url:"/user/like",
           method:'post',
           datatype:'json',
           data:{_token:token,post_id:postId},
           beforeSend:function(){
           },
           success:function(data){


             $(".like_unlike_post").removeClass('fa-heart-o').addClass('fa-heart');
		       $(".like_unlike_post").attr('data-status','like');

            if($.isNumeric($('.count_like').text())){
                var getcount = parseInt($('.count_like').text() ) + 1 ;
                $('.count_like').text(getcount);

               }

           },
           error:function(data){

             if(data.status == 401){

                window.location.href = login;
             }

           }
        
       });

        } // end else
    

    });

//------------------- end file blade show like and unlike  ----------------------

//-------------------  file blade show comment -------------------------


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
          var postId = $(this).closest("div.post-show").attr("data-id");
          var user_comment = $(this).closest("div.post-show").find(".comment");

        if(user_comment.val().length > 0){

		        $.ajax({  
		           url:"/user/comment",
		           method:'post',
		           datatype:'html',
		           data:{_token:token,post_id:postId,comment:user_comment.val()},
		           beforeSend:function(){

		           	  $(user_comment).val('');

		           },
		           success:function(data){


		           $(".comments").append(data.data);

		           },
		           error:function(data){

		             if(data.status == 401){

		                window.location.href = login;
		             }

		           }
		        
		       }); //end ajax

       }


     }

 });


//------------------- end file blade show comment  ----------------------


//------------------- file blade show show setting comment  ----------------------

$(document).on('click','.show_setting',function(){
	
	var get_comment_id = $(this).data('comment_id');
	var get_post_id = $(this).closest("div.post-show").attr("data-id");


	$("#showSettng").attr('data-id',get_comment_id);
	$("#showSettng").attr('data-id-post',get_post_id);



  $('#showSettng').modal('show');	

});


//------------------------------------------------------------------------

$(document).on('click','.buton-delete',function(){

	var comment_id = $(this).closest("div #showSettng").attr("data-id");
    var postId = $(this).closest("div #showSettng").attr("data-id-post");


	 if(comment_id){

		        $.ajax({  
		           url:"/user/comment/delete",
		           method:'post',
		           datatype:'json',
		           data:{_token:token,comment:comment_id,post_id:postId},
		           beforeSend:function(){
                      	 $(".deleteLoading").removeClass('d-none');

		           },
		           success:function(data){
                      if(data.status == "ok"){
                          var getPareeent = ".comment-" + comment_id;
                        setTimeout(function(){
                        	 $(getPareeent).remove();
                      	     $(".deleteLoading").addClass('d-none');
                      	     $('#showSettng').modal('hide');	
                        },1000); 

                      }

		           },
		           error:function(data){

		             if(data.status == 401){

		                window.location.href = login;
		             }
		              if(data.status == 404){
	                     $('#showSettng').modal('hide');	
		             }

		           }
		        
		       }); //end ajax
	 }
});



//------------------- end file blade show setting comment  ----------------------

//----------------------------show post setting -----------------------------

$(".buttonSettingPost").click(function(){
	$("#showSettngPost").modal('show');

});

//-------------------------------------------------------------------


}); //end jquey


