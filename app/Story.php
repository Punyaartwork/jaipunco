<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable=['user_id','story','storyPhoto','storyDetail','storyBg','storyColor','storyItem','storyLike','storyView','storyComment','storyShare','storyTime','storyTags','story_ip']; 
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
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
