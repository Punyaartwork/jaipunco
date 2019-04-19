<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drawname extends Model
{
    protected $fillable=['user_id','drawName','drawDetail','drawTag','drawUse','drawTime','draw_ip'];        
}
