<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserIdAndFollowerIdFromUserFollowers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_followers', function (Blueprint $table) {
            $table->dropForeign('user_followers_user_id_foreign');
            $table->dropIndex('user_followers_user_id_foreign');
            $table->dropForeign('user_followers_follower_id_foreign');
            $table->dropIndex('user_followers_follower_id_foreign');
            $table->dropColumn('follower_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_followers', function (Blueprint $table) {
            //
        });
    }
}
