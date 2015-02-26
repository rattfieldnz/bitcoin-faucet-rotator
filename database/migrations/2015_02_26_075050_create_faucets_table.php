<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaucetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faucets', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('url')->unique();
            $table->integer('interval_minutes');
            $table->integer('payout_amount');
            $table->boolean('has_ref_program');
            $table->decimal('ref_payout_percent',5,2);
            $table->boolean('is_paused')->default(0);
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
		Schema::drop('faucets');
	}

}
