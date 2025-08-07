<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('base_image')->nullable();
			$table->string('username', 100)->nullable();
			$table->string('gender', 60)->nullable();
			$table->string('first_name', 191)->nullable();
			$table->string('last_name', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->text('tag')->nullable();
			$table->integer('country')->nullable();
			$table->string('state', 60)->nullable();
			$table->string('city', 191)->nullable();
			$table->string('zipcode', 10)->nullable();
			$table->string('phone_number', 191)->nullable();
			$table->float('balance',10,2)->nullable();
			$table->string('secret_question', 191)->nullable();
			$table->string('secret_answer', 191)->nullable();
			$table->string('language', 191)->nullable();
			$table->boolean('status', 2)->default(1);
			$table->timestamps();

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
		Schema::drop('user_profiles');
	}

}
