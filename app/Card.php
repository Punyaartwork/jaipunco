<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable=['user_id','card','cardPhoto','cardBg','cardView','cardLike','cardComment','cardShare','cardTime','card_ip','cardColor','cardDetail','subject_id','post_id','cardTags','cardForm']; 
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    } 
    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }   /*       
    public function like()
    {
        return $this->hasMany('App\Like','post_id')->where('likes.likeType', '=', 3);
    }  
    public function comments()
    {
        return $this->hasMany('App\Comment','post_id')->with('user')->whereNull('parent_id')->where('comments.commentType', '=', 3);
    }  */
}
