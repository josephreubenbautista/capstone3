<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
           $table->increments('id');
            $table->date('date');
            $table->string('venue');
            $table->time('time');
            $table->unsignedInteger('league_id')->nullable();
            $table->unsignedInteger('home_team_id')->nullable();
            $table->unsignedInteger('away_team_id')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
