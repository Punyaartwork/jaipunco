<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $fillable=[
        'facebook_id',
        'name',
        'detail',        
        'email',
        'profile',        
        'password',
        'cards',
        'following',
        'followers',
        'notification',
        'downloading',
        'boons',
        'status',
        'status_id',
        'ranking',
        'link',
        'api_token',
        'joiner',
        'joining',
        'watyear',
        'online',
    ];
    protected $hidden = [
        'password','api_token'
    ];
  
   /* public function likes()
    {
        return $this->belongsToMany('App\Post', 'likes', 'user_id', 'post_id');
    }   */
    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
    public function following() {  
        return $this->BelongsToMany( 'App\User', 'App\Follow' ,'fuser_id', 'user_id');
    } 
    public function merit()
    {
        return $this->belongsTo('App\Merit', 'user_id');
    }      
}
