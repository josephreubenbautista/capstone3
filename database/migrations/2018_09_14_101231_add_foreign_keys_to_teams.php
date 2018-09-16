<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->foreign('league_id')
                    ->references('id')
                    ->on('leagues')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');

            $table->foreign('captain_player_id')
                    ->references('id')
                    ->on('players')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign('league_id');
            $table->dropForeign('captain_player_id');
        });
    }
}
