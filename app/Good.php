<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable=['good','goodPhoto','goodDetail','goodBg','goodColor','goodItem','goodTags','goodTime','good_ip']; 
}
