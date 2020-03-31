<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class checkProfile
{
    use HandlesAuthorization;




    public function myAccount($user,$profile)
    {

        if($user->username == $profile->username){
             return true;
        }else{
            return false;
        }
          


        
    }

  


}
