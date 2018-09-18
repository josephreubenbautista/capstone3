<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	public $timestamps = false;


    function user(){
    	return $this->belongsTo('App\User');
    }

    function team(){
    	return $this->belongsTo('App\Team');
    }

    function league(){
    	return $this->belongsTo('\App\League');
    }
}
