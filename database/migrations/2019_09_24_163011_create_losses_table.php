<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLossesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('losses', function(Blueprint $table)
		{
			$table->bigInteger('id')->unsigned()->primary();
			$table->integer('user_id')->unsigned();
			$table->string('type', 191)->nullable();
			$table->integer('amount')->nullable();
			$table->string('from', 191);
			$table->string('to', 191);
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
		Schema::drop('losses');
	}

}
