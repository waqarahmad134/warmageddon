<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('add_games', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order')->nullable();
			$table->string('game_title', 191)->nullable()->unique();
			$table->string('game_meta', 191)->nullable();
			$table->text('game_description')->nullable();
			$table->string('base_image', 191)->nullable();
			$table->string('game_category', 191)->nullable();
			$table->string('game_file', 191)->nullable();
			$table->string('json', 191)->nullable();
			$table->string('game_type', 91)->nullable();
			$table->string('status', 10)->nullable()->default('on');
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
		Schema::drop('add_games');
	}

}
