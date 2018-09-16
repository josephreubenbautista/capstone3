<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToFans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fans', function (Blueprint $table) {
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');

            $table->foreign('fan_user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::table('fans', function (Blueprint $table) {
            $table->dropForeign('fan_user_id');
            $table->dropForeign('user_id');
        });
    }
}
