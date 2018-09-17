<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
     public $timestamps = false;

     function teams(){
     	return $this->hasMany('App\Team');
     }
}
