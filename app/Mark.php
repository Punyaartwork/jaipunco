<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Mark extends Model
{
    use SoftDeletes;
    protected $fillable=['post_id','user_id','markTime'];  
}
