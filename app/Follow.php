<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    use SoftDeletes;
    protected $fillable=['fuser_id','user_id'];   
    public function fuser()
    {
        return $this->belongsTo('App\User', 'fuser_id');
    }  
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }  
}
