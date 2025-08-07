<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddFreeChipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('add_free_chips', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_name', 191);
			$table->integer('bonus_amount');
			$table->integer('unlock_bonus_time');
			$table->integer('total_amount');
			$table->string('bonus_mode', 30);
			$table->timestamps();
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
		Schema::drop('add_free_chips');
	}

}
