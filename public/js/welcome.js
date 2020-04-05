$(function(){

     var token = $('meta[name="csrf-token"]').attr('content');
     var login = "/login";



//-----------------------like unlike-----------------------------------



         $('body').on('click','.like_unlike',function(){

            
            var postId = $(this).closest('div.card').data('id');
            var countSpan = $(this).closest('div.card').find('.count_like');
            var likeStatus = $(this).attr('data-status');



             if(likeStatus == 'liked'){

                 
                        $(this).removeClass('fa-heart').addClass('fa-heart-o');
                       $(this).attr('data-status','like');



           $.ajax({   //send request to unlike

                   url:"/user/unlike",
                   method:'post',
                   datatype:'json',
                   data:{_token:token,post_id:postId},
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

                       url:"/user/like",
                       method:'post',
                       datatype:'json',
                       data:{_token:token,post_id:postId},
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

                            window.location.href = login;
                         }

                       }
                    
                   });


             } //end if status = like

         });


//-------------------------------------------------------------
//------------------------add comment--------------------------------

  $(document).on("keyup",'.commentPost',function(){

         if($(this).val().length > 0){

            $(this).closest("div.card").find('.addComment').removeClass('disabled');

         }else{
            $(this).closest("div.card").find('.addComment').addClass('disabled');
         }


      });


          //-------------------------------------------------

      $(document).on('click','.addComment',function(){

        var comment = $(this).closest("div.card").find(".commentPost");
        var appendComment = $(this).closest("div.card").find(".showLatestComment");
        var postId = $(this).closest("div.card").data('id');

          if(comment.val().length > 0){

                $.ajax({  
                   url:"/add/comment",
                   method:'post',
                   datatype:'html',
                   data:{_token:token,post_id:postId,comment:comment.val()},
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

                        window.location.href = login;
                     }

                   }
                
               }); //end ajax



          } // end if comment > 0


      });


//-------------------------------------------------------
});     //end jquery