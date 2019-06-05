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
}
