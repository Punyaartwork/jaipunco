<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Join extends Model
{
    use SoftDeletes;
    protected $fillable=['boon_id','good_id','user_id','join','joinType','joinTime'];    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    } 
    public function boon()
    {
        return $this->belongsTo('App\Boon', 'boon_id');
    } 
}
