<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToActivityLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');

            $table->foreign('who_user_id')
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
        Schema::table('activity_logs', function (Blueprint $table) {
             $table->dropForeign('user_id');
            $table->dropForeign('who_user_id');
        });
    }
}
