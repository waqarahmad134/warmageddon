<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBalancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('balances', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('method_id')->nullable();
			$table->float('balance',10,2)->nullable();
			$table->string('from', 50)->nullable();
			$table->string('to', 50)->nullable();
			$table->string('type', 100)->nullable();
			$table->string('amount_sign', 100)->nullable();
			$table->timestamps();
			
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')
			->references('id')->on('users')
			->onDelete('cascade');
			
			$table->BigInteger('account_id')->nullable()->unsigned()->index();
			$table->foreign('account_id')
			->references('id')->on('accounts')
			->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('balances');
	}

}
