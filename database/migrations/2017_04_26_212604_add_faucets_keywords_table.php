<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFaucetsKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faucets_keywords', function (Blueprint $table) {
            $table->integer('faucet_id')->unsigned()->index();
            $table->foreign('faucet_id')->references('id')->on('faucets');
            $table->integer('keyword_id')->unsigned()->index();
            $table->foreign('keyword_id')->references('id')->on('keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faucets_keywords');
    }
}
