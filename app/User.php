<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable=['facebook_id','name','detail','email','profile','password','stories','following','followers','notification','link'];    
}
