<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBanIPsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ban_i_ps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('client_ip', 30);
			$table->integer('duration_minutes');
			$table->date('ban_start_date');
			$table->string('type', 30);
			$table->timestamps();
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
		Schema::drop('ban_i_ps');
	}

}
