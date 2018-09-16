<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');

            $table->foreign('team_id')
                    ->references('id')
                    ->on('teams')
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
        Schema::table('players', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('team_id');
            $table->dropForeign('league_id');
        });
    }
}
