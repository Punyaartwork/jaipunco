<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    protected $fillable=['user_id','good_id','room','roomLike','roomType','roomTime'];    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    } 
    public function good()
    {
        return $this->belongsTo('App\Good', 'good_id');
    } 
}
