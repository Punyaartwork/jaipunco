<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admire extends Model
{
    protected $fillable=['user_id','sender_id','votes','admire','admireTime'];    
    public function user()
    {
        return $this->belongsTo('App\User', 'sender_id');
    } 
}
