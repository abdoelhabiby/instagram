// $(function(){

//      var token = $('meta[name="csrf-token"]').attr('content');
//      var login = "/login";


// // ------------------ follow and unfollow ------------------------------


//     $(document).on('click','.foll_unfol',function(){
//       var profileId = $(this).data('profile_id');
//       var status = $(this).attr('data-id');
 
//         if (status == 'yes') {
//                 $.ajax({   //send request to unfollow

//                    url:"/user/unfollow",
//                    method:'post',
//                    datatype:'json',
//                    data:{_token:token,profile_id:profileId},
//                    beforeSend:function(){
//                      $(".loadingSpin").removeClass('d-none');
//                    },
//                    success:function(data){
                     
//                      $('.foll_unfol').text('Follow');
//                      $(".loadingSpin").addClass('d-none');
//                      $('.foll_unfol').attr('data-id','no');

//                      if($.isNumeric($('.change_count_followers').text())){
//                          var getcount = parseInt($('.change_count_followers').text()) -1 ;
//                          $('.change_count_followers').text(getcount);
//                      }
//                    },
//                    error:function(data){

//                      if(data.status == 401){

//                         window.location.href = login;
//                      }

//                    }
                
//                });
//         }

//        if (status == 'no'){  //send request to follow

//          $.ajax({  

//            url:"/user/follow",
//            method:'post',
//            datatype:'json',
//            data:{_token:token,profile_id:profileId},
//            beforeSend:function(){
//              $(".loadingSpin").removeClass('d-none');
//            },
//            success:function(data){

//             $('.foll_unfol').text('Following');
//             $('.foll_unfol').attr('data-id','yes');
//              $(".loadingSpin").addClass('d-none');

//             if($.isNumeric($('.change_count_followers').text())){
//                 var getcount = parseInt($('.change_count_followers').text() ) + 1 ;
//                 $('.change_count_followers').text(getcount);

//                }
//            },
//            error:function(data){

//              if(data.status == 401){

//                 window.location.href = login;
//              }

//            }
//        });
//         } // end else
    
//     });


// // ------------------ end follow and unfollow ------------------------------


// //-------------------------change follow and unfollow form profile page--------

   
//   $(document).on('click',"#modal-unfollow",function(){
//     var modaldelete = $(this).closest(".modal .showFolloweingModal");
//     var profileId = $(modaldelete).data("id");
//     var textButton = $(modaldelete).find(".textButton");
//     var loading = $(modaldelete).find(".loadingFollow");

//                 $.ajax({
//                    url:"/user/unfollow",
//                    method:'post',
//                    datatype:'json',
//                    data:{_token:token,profile_id:profileId},
//                    beforeSend:function(){
//                          $(textButton).addClass("d-none");
//                          $(loading).removeClass("d-none");
//                    },
//                    success:function(data){

//                      $(loading).addClass("d-none"); 
//                      $(modaldelete).remove();
//                   if($.isNumeric($('.change_count_following').text())){
//                        var getcount = parseInt($('.change_count_following').text() ) - 1 ;
//                        $('.change_count_following').text(getcount);
//                      }
//                    },
//                    error:function(data){
//                      if(data.status == 401){
//                         window.location.href = login;
//                      }
//                    }
//                });

// }); 

// //---------------------------------------------------------------------

//      $(document).on('click',"#modal-follow-unfollow",function(){
         
//          var profileId = $(this).closest(".modal .showFolloweingModal").data("id");
//          var loading = $(this).closest(".modal .showFolloweingModal").find(".loadingFollow");
//          var textButton = $(this).closest(".modal .showFolloweingModal").find(".textButton");
//          var status = $(this).closest(".modal .showFolloweingModal").find("#modal-follow-unfollow");

            
//             if(status.data('status') == 'following'){  //sen request to unfollow

//                  $.ajax({

//                    url:"/user/unfollow",
//                    method:'post',
//                    datatype:'json',
//                    data:{_token:token,profile_id:profileId},
//                    beforeSend:function(){
//                          $(textButton).addClass("d-none");
//                          $(loading).removeClass("d-none");
//                    },
//                    success:function(data){

//                      $(loading).addClass("d-none"); 
//                      $(textButton).removeClass("d-none").text('Follow');

//                      $(status).attr('data-status','follow') 

                    
//                    },
//                    error:function(data){

//                      if(data.status == 401){

//                         window.location.href = login;
//                      }
//                      $(loading).addClass("d-none"); 
//                      $(status).attr('data-status','following');
//                      $(textButton).removeClass("d-none").text('Following');

//                    }
                
//                });

//             }  // end if status == following
           
//   //----------------------------------------------------------

//               if(status.data('status') == 'follow'){  //sen request to follow

//                  $.ajax({

//                    url:"/user/follow",
//                    method:'post',
//                    datatype:'json',
//                    data:{_token:token,profile_id:profileId},
//                    beforeSend:function(){
//                          $(textButton).addClass("d-none");
//                          $(loading).removeClass("d-none");
//                    },
//                    success:function(data){

//                      $(loading).addClass("d-none"); 
//                      $(textButton).removeClass("d-none").text('Following');

//                      $(status).attr('data-status','following') 

                    
//                    },
//                    error:function(data){

//                      if(data.status == 401){

//                         window.location.href = login;
//                      }
//                      $(loading).addClass("d-none"); 
//                      $(status).attr('data-status','follow');
//                      $(textButton).removeClass("d-none").text('Follow');

//                    }
                
//                });

//             }  // end if status == following


//      }); // end button follow unfollow

// //----------------------------------------------------



// });
