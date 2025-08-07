<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWagersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wagers', function(Blueprint $table)
		{
			$table->bigInteger('id')->unsigned()->primary();
			$table->integer('user_id');
			$table->integer('wager_limit');
			$table->integer('los_limit');
			$table->integer('deposit_limit');
			$table->integer('session_limit');
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
		Schema::drop('wagers');
	}

}
