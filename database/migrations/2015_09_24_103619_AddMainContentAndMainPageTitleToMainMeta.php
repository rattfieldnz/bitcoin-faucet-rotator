<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddMainContentAndMainPageTitleToMainMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_meta', function (Blueprint $table) {
            $table->string('page_main_title', 100);
            $table->text('page_main_content')->nullable();
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
            $table->dropColumn('page_main_title');
            $table->dropColumn('page_main_content');
        });
    }
}
