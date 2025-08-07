<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenerateLotteryTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('generate_lottery_tickets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 100)->nullable();
			$table->string('nr_of_tickts', 191)->nullable();
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
		Schema::drop('generate_lottery_tickets');
	}

}
