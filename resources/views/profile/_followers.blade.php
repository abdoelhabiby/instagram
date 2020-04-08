
       @foreach($followers as $profile)   
           <div class="row showFollowersModal" data-id="{{$profile->id}}" id="{{$profile->id}}">
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