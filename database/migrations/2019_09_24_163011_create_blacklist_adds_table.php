<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlacklistAddsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blacklist_adds', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->boolean('status')->default(1);
			$table->longText('reason')->nullable();
			$table->string('type', 100)->nullable();

			$table->integer('user_id')->nullable()->unsigned()->index('blacklist_adds_001');
            $table->foreign('user_id','blacklist_adds_001')->references('id')->on('users')
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
		Schema::drop('blacklist_adds');
	}

}
