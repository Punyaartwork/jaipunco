<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['user_id','type_id','tagname','tagDraw','tagDetail','tagStories','tagVotes'];   
    
    public function type()
    {
        return $this->belongsTo('App\Type', 'type_id');
    } 
}
