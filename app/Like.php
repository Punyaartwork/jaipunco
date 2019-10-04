<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;
    protected $fillable=['card_id','user_id','likeType'];    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    } 
}
