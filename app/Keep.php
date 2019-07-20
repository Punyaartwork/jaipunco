<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Keep extends Model
{
    use SoftDeletes;
    protected $fillable=['card_id','user_id','keepTime'];  
}
