<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoggedinUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('loggedin_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('history_staff');
			$table->foreign('user_id','history_staff')
			->references('id')->on('users')
			->onDelete('cascade');
			$table->string('s_id')->nullable();
			$table->timestamps();
			$table->boolean('status')->default('1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('loggedin_users');
	}

}
