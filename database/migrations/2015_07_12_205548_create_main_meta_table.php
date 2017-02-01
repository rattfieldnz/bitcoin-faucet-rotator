<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateMainMetaTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 70)->nullable();
            $table->string('description', 160)->nullable();
            $table->string('keywords', 255)->nullable();
            $table->string('google_analytics_id', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('main_meta');
    }
}
