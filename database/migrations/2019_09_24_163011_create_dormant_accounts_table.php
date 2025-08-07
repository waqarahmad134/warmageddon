<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDormantAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dormant_accounts', function(Blueprint $table)
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
		Schema::drop('dormant_accounts');
	}

}
