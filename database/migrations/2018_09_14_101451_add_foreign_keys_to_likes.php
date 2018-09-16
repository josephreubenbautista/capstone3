<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('SET NULL')
                    ->onUpdate('CASCADE');

            $table->foreign('user_id')
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
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign('post_id');
            $table->dropForeign('user_id');
        });
    }
}
