<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merit extends Model
{
    use SoftDeletes;
    protected $fillable=['good_id','user_id','merit','meritTime'];    
}
