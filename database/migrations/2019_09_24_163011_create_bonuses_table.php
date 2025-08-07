<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBonusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bonuses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('add_bonus_id')->nullable();
			$table->string('type', 191)->nullable();
			$table->float('amount',10,2)->nullable();
			$table->integer('spin')->nullable();
            $table->integer('token')->nullable();
            $table->integer('betsize')->nullable();
            $table->integer('line')->nullable();
			$table->string('from', 191)->nullable();
			$table->string('to', 191)->nullable();
			$table->timestamps();
			
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')
			->references('id')->on('users')
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
		Schema::drop('bonuses');
	}

}
