<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddDisqusShortnameToMainmeta
 */
class AddDisqusShortnameToMainmeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_meta', function (Blueprint $table) {
            $table->string('disqus_shortname', 100)->nullable();
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
            $table->dropColumn('disqus_shortname');
        });
    }
}
