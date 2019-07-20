<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable=['user_id','storeName','storeDetail','storeTag','drawings','likes','reviews','storeTime','store_ip'];        
}
