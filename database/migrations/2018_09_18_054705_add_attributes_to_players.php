<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributesToPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->decimal('ppg', 5, 2)->nullable();
            $table->decimal('rpg', 5, 2)->nullable();
            $table->decimal('apg', 5, 2)->nullable();
            $table->decimal('bpg', 5, 2)->nullable();
            $table->decimal('spg', 5, 2)->nullable();
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
            $table->dropColumn('ppg');
            $table->dropColumn('rpg');
            $table->dropColumn('apg');
            $table->dropColumn('bpg');
            $table->dropColumn('spg');
        });
    }
}
