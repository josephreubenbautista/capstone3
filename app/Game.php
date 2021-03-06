<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Game extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $dates =['deleted_at'];
    function league(){
    	return $this->belongsTo('\App\League');
    }



    function awayteam() {
     	return $this->belongsTo('\App\Team', 'away_team_id');
    }

    function hometeam() {
     	return $this->belongsTo('\App\Team', 'home_team_id');
    }

    function statistics(){
    	return $this->hasMany('\App\Statistic');
    }
}
