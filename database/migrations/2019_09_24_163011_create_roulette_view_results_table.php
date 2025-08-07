<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouletteViewResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roulette_view_results', function(Blueprint $table)
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
		Schema::drop('roulette_view_results');
	}

}
