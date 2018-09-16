<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('points');
            $table->integer('assists');
            $table->integer('steals');
            $table->integer('blocks');

             $table->unsignedInteger('game_id')->nullable();
            $table->unsignedInteger('player_id')->nullable();
            $table->unsignedInteger('league_id')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
