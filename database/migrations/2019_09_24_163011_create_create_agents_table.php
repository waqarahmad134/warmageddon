<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreateAgentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('create_agents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('subagent', 50)->nullable();
			$table->integer('revenue_percent')->nullable();
			$table->integer('balance')->nullable();
			$table->timestamps();
			$table->integer('user_id')->nullable();
			$table->boolean('status')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('create_agents');
	}

}
