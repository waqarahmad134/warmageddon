<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreditTransfersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('credit_transfers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_id');
			$table->date('start_date');
			$table->date('end_date');
			$table->string('comparisson_sign', 80);
			$table->integer('amount');
			$table->string('player_username', 50)->nullable();
			$table->string('agent_username', 50)->nullable();
			$table->string('credit_received', 100)->nullable();
			$table->string('credit_sent', 50)->nullable();
			$table->string('payments_for_affiliates', 100)->nullable();
			$table->string('refunded_gameplays', 100)->nullable();
			$table->string('exceeding_amount', 100)->nullable();
			$table->timestamps();
			$table->string('status', 191)->default('1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('credit_transfers');
	}

}
