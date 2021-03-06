<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locat extends Model
{
    protected $fillable=['locat','locatPhoto','locatBg','locatColor','locatLatitude','locatLongitude','locatDistance','locatItem','locatTime'];
    public function good()
    {
        return $this->hasMany('App\Good', 'locat_id');
    }     
}