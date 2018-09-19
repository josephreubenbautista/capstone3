<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $timestamps = false;

    function league(){
    	return $this->belongsTo('\App\League');
    }

    function players(){
    	return $this->hasMany('\App\Player');
    }


    function games(){
    	return $this->hasMany('\App\Game');
    }
}
