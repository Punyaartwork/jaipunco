<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merit extends Model
{
    use SoftDeletes;
    protected $fillable=['good_id','user_id','status_id','meritItem','meritLike','meritTime'];   
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }  
    public function good()
    {
        return $this->belongsTo('App\Good', 'good_id');
    }  
}
