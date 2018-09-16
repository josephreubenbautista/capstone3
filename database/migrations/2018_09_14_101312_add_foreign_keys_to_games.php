<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->foreign('league_id')
                    ->references('id')
                    ->on('leagues')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');

            $table->foreign('home_team_id')
                    ->references('id')
                    ->on('teams')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');

            $table->foreign('away_team_id')
                    ->references('id')
                    ->on('teams')
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
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign('league_id');
            $table->dropForeign('home_team_id');
            $table->dropForeign('away_team_id');
        });
    }
}
