<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddBonusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('add_bonuses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('bonus_name', 191)->nullable();
			$table->string('b_code', 191)->nullable();
			$table->integer('b_amount');
			$table->integer('w_limit')->nullable();
			$table->integer('u_limit')->nullable();
			$table->integer('d_limit')->nullable();
			$table->integer('limit_amount')->nullable();
			$table->date('expire_date')->nullable();
			$table->string('image', 191)->nullable();
			$table->timestamps();
			$table->string('type', 60)->nullable();
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
		Schema::drop('add_bonuses');
	}

}
