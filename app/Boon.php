<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boon extends Model
{
    protected $fillable=['user_id','boonName','boon','boonView','boonLike','boonComment','boonShare','boonTime','boon_ip'];  
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }      
    public function photo()
    {
        return $this->hasMany('App\Photo');
    }  
    public function like()
    {
        return $this->hasMany('App\Like','post_id')->where('likes.likeType', '=', 2);
    }  
    public function comments()
    {
        return $this->hasMany('App\Comment','post_id')->with('user')->whereNull('parent_id')->where('comments.commentType', '=', 2);
    } 
}
