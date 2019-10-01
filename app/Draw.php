<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    protected $fillable=['drawname_id','draw','alt','good_id','drawLevel','drawStatus'];        
}
