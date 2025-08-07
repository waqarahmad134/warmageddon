<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreateOperatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('create_operators', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('subagent', 60)->nullable();
			$table->timestamps();
			$table->boolean('status')->nullable()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('create_operators');
	}

}
