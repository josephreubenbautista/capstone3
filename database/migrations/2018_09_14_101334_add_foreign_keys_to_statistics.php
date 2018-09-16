<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToStatistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statistics', function (Blueprint $table) {
            $table->foreign('game_id')
                    ->references('id')
                    ->on('games')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');

            $table->foreign('player_id')
                    ->references('id')
                    ->on('players')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');

            $table->foreign('league_id')
                    ->references('id')
                    ->on('leagues')
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
        Schema::table('statistics', function (Blueprint $table) {
            $table->dropForeign('game_id');
            $table->dropForeign('player_id');
            $table->dropForeign('league_id');
        });
    }
}
