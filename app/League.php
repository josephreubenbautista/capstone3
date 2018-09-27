<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class League extends Model
{
     use SoftDeletes;
     public $timestamps = false;
     protected $dates =['deleted_at'];
     function teams(){
     	return $this->hasMany('\App\Team');
     }

     function players(){
     	return $this->hasMany('\App\Player');
     }

     function users() {
     	return $this->belongsToMany('\App\User', 'players');
     }

     function games(){
          return $this->hasMany('\App\Game');
     }
}
