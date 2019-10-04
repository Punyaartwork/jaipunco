<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boon extends Model
{
    protected $fillable=['user_id','good_id','boon','boonPhoto','boonDetail','boonBg','boonColor','boonForm',
    'boonLike','boonComment','boonView','boonShare','boonTime','boonTags','boon_ip']; 
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    } 
    public function good()
    {
        return $this->belongsTo('App\Good', 'good_id');
    }       
    public function like()
    {
        return $this->hasMany('App\Like','card_id')->where('likes.likeType', '=', 2);
    }  
    public function comments()
    {
        return $this->hasMany('App\Comment','card_id')->with('user')->whereNull('parent_id')->where('comments.commentType', '=', 1);
    }  
}