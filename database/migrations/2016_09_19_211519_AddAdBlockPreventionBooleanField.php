<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdBlockPreventionBooleanField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_meta', function (Blueprint $table) {
            $table->boolean('prevent_adblock_blocking')->default(false);
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
            $table->dropColumn('prevent_adblock_blocking');
        });
    }
}
