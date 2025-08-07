<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddRewardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('add_rewards', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 191);
			$table->integer('bonus_amount');
			$table->date('expire_date');
			$table->string('type', 60);
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
		Schema::drop('add_rewards');
	}

}
