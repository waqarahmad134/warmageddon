<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id', true)->unsigned();
			$table->string('first_name', 191)->nullable();
			$table->string('last_name', 191)->nullable();
			$table->string('user_name', 191)->nullable();
			$table->string('street', 191)->nullable();
			$table->string('city', 191)->nullable();
			$table->string('country', 191)->nullable();
			$table->string('phone', 191)->nullable();
			$table->date('dob')->nullable();
			$table->string('email', 191)->unique()->nullable();
			$table->string('image')->nullable();
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password', 191)->nullable();
			$table->string('ip_address', 30)->nullable();
			$table->dateTime('last_login_at')->nullable();
			$table->string('last_login_ip', 100)->nullable()->default('0000-00-00 00:00:00');
			$table->integer('role_id')->nullable();
			$table->integer('aff_id')->nullable();
			$table->boolean('verified')->default(0);
			$table->string('country_code',30)->nullable();
			$table->boolean('phone_verification')->default(0);
			$table->boolean('status')->nullable()->default(1);
			$table->boolean('access_status')->default(1);
			$table->boolean('game_status')->default(0);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
