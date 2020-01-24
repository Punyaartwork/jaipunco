<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable=['user_id','item_id','item','itemType','notificationStatus','notificationTime','sender'];  
    public function card()
    {
        return $this->belongsTo('App\Card', 'item_id');
    }      
    public function boon()
    {
        return $this->belongsTo('App\Boon', 'item_id');
    } 
    public function locat()
    {
        return $this->belongsTo('App\Locat', 'item_id');
    } 
    public function sender()
    {
        return $this->belongsTo('App\User', 'sender');
    }     
}
