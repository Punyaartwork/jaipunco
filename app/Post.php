<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['user_id','post','postPhoto','postDetail','postBg','postColor','postItem','postLike','postView','postComment','postShare','postTime','postTags','post_ip']; 
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }  
    public function follow() {  
        return $this->BelongsToMany( 'App\User', 'App\Follow' ,'fuser_id', 'user_id');
    } /*       
    public function like()
    {
        return $this->hasMany('App\Like','post_id')->where('likes.likeType', '=', 3);
    }  
    public function comments()
    {
        return $this->hasMany('App\Comment','post_id')->with('user')->whereNull('parent_id')->where('comments.commentType', '=', 3);
    }  */
}
