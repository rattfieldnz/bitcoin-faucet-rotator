<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddLowFaucetBalanceField extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faucets', function (Blueprint $table) {
            $table->boolean('has_low_balance')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faucets', function (Blueprint $table) {
            $table->dropColumn('has_low_balance');
        });
    }
}
