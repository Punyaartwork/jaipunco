<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable=['facebook_id','name','detail','email','profile','password','stories','following','followers','notification','link','boons','cards','power'];  
    public function likes()
    {
        return $this->belongsToMany('App\Post', 'likes', 'user_id', 'post_id');
    }   
}
