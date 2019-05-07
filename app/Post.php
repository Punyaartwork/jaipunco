<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['user_id','tag_id','postName','post','postDraw','postView','postLike','postComment','postShare','postTime','post_ip'];
    public function tag()
    {
        return $this->belongsTo('App\Tag', 'tag_id');
    }    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }          
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }  
    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes');
    }
}
