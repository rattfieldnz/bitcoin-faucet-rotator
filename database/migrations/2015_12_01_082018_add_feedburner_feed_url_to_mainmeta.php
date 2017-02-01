<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddFeedburnerFeedUrlToMainmeta
 */
class AddFeedburnerFeedUrlToMainmeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_meta', function (Blueprint $table) {
            $table->string('feedburner_feed_url', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_meta', function (Blueprint $table) {
            $table->dropColumn('feedburner_feed_url');
        });
    }
}
