<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')
			->references('id')->on('users')
			->onDelete('cascade');
			$table->float('admin_total',10,2)->nullable();
			$table->float('total',10,2)->nullable();
			$table->float('balance',10,2)->nullable();
			$table->integer('total_spin')->nullable()->default(0);
			$table->boolean('status')->default(1);
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
		Schema::drop('accounts');
	}

}
