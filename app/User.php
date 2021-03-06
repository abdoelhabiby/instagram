<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Mail\WelcomeMessage;


class User extends Authenticatable
{
    use Notifiable;


 protected static function boot(){

      parent::boot();

      static::created(function($user){

       \Mail::to($user->email)->send(new WelcomeMessage());
 
      });

 }



    /**
//------------------------------------------------------------

     */
    protected $fillable = [
        'name', 'username','email', 'password','description','url','img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



        public function posts(){
            return $this->hasMany(Post::class);
        }        


     



        public function following(){

             return $this->belongsToMany(User::class,'follows','user_id','profile_id');
        }


        public function followers(){

             return $this->belongsToMany(User::class,'follows','profile_id','user_id');
        }




      
}
