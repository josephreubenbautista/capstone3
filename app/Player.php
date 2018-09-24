<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Player extends Model
{
	public $timestamps = false;
    protected $dates =['deleted_at'];

    function user(){
    	return $this->belongsTo('App\User');
    }

    function team(){
    	return $this->belongsTo('App\Team');
    }

    function league(){
    	return $this->belongsTo('\App\League');
    }

    function statistics(){
        return $this->hasmany('\App\Statistic');
    }

    

    
}
