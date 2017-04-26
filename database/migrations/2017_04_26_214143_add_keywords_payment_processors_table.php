<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeywordsPaymentProcessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords_payment_processors', function (Blueprint $table) {
            $table->integer('keyword_id')->unsigned()->index();
            $table->foreign('keyword_id')->references('id')->on('keywords');
            $table->integer('payment_processor_id')->unsigned()->index();
            $table->foreign('payment_processor_id')->references('id')->on('payment_processors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('keywords_payment_processors');
    }
}
