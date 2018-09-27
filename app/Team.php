<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Team extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $dates =['deleted_at'];

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
