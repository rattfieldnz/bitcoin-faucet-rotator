<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFaucetPaymentProcessorPivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faucet_payment_processor', function(Blueprint $table)
		{
			$table->integer('faucet_id')->unsigned()->index();
			$table->foreign('faucet_id')->references('id')->on('faucets')->onDelete('cascade');
			$table->integer('payment_processor_id')->unsigned()->index();
			$table->foreign('payment_processor_id')->references('id')->on('payment_processors')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('faucet_payment_processor');
	}

}
