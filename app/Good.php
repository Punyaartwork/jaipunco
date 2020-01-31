<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable=['good','goodPhoto','goodDetail','goodBg','goodColor',
    'goodItem','goodTags','goodTime','good_ip','goodLatitude','goodLongitude',
    'goodDistance','goodOnline','locat_id','status_id',
    'goodStory','goodIcon','goodDhamma','goodResult','goodLike','goodView','goodDonate','goodDonateMax'
]; 
    public function boon()
    {
        return $this->hasMany('App\Boon')->latest()->with('user');
    } 
}
