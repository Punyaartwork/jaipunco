<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admire extends Model
{
    protected $fillable=['user_id','votes','admire','admireTime'];    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    } 
}
