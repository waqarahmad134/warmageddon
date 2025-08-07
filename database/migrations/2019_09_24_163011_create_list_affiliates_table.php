<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateListAffiliatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('list_affiliates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 191);
			$table->integer('aff_id');
			$table->boolean('status', 2)->default('1');

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
		Schema::drop('list_affiliates');
	}

}
