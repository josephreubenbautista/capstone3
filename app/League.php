<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
     public $timestamps = false;

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
