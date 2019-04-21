<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['user_id','type_id','tagname','tagDraw','tagDetail','tagStories','tagVotes','tagDate','tagColor'];   
    
    public function type()
    {
        return $this->belongsTo('App\Type', 'type_id');
    } 
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }   
}
