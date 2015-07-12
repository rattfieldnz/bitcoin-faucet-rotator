<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateSiteWideMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_wide_meta', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 70)->nullable();
			$table->string('description', 160)->nullable();
			$table->string('keywords', 255)->nullable();
			$table->text('google_analytics_code')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_wide_meta');
	}

}
