<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Join extends Model
{
    use SoftDeletes;
    protected $fillable=['good_id','boon_id','user_id','join','joinType','joinTime'];    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    } 
}
