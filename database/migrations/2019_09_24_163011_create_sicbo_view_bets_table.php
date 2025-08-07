<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSicboViewBetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sicbo_view_bets', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->timestamps();
			$table->string('name', 191);
			$table->string('status', 191);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sicbo_view_bets');
	}

}
