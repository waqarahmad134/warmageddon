<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeneralSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('general_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('currency', 191)->nullable();
            $table->double('min_deposit', 191)->nullable()->default(0);
            $table->double('min_withdraw', 191)->nullable()->default(0);
			$table->integer('inactive_days')->nullable();
			$table->integer('fun_game')->nullable();
			$table->integer('real_game')->nullable();
			$table->boolean('status')->default(1);
			$table->timestamps();

		});
		DB::table('general_settings')->insert([
			'status'=>1
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('general_settings');
	}

}
