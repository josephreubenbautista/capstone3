<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public $timestamps = false;

    function player(){
    	return $this->belongsTo('\App\Player');
    }

    // function game(){
    // 	return $this->belongsTo('\App\Game');
    // }
}
