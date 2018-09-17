<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    function user(){
    	return $this->belongsTo('App\User');
    }

    function team(){
    	return $this->belongsTo('App\Team');
    }
}
