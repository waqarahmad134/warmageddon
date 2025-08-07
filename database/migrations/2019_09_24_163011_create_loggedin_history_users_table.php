<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoggedinHistoryUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('loggedin_history_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('login_history_01');
			$table->foreign('user_id','login_history_01')
			->references('id')->on('users')
			->onDelete('cascade');
			$table->string('device', 191)->nullable();
			$table->string('browser', 191)->nullable();
			$table->boolean('status')->default('1');
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
		Schema::drop('loggedin_history_users');
	}

}
