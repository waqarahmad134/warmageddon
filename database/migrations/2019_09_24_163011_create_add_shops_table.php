<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('add_shops', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->string('base_image')->nullable();
			$table->integer('spin')->nullable();
			$table->float('price',10,2)->nullable();
			$table->integer('amount')->nullable();
			$table->string('type', 30)->nullable();
			$table->boolean('status')->default(1);
			$table->timestamps();
		});

		DB::table('add_shops')->insert([
            'name'=>'Silver',
            'price'=>10,
            'amount'=>5000,
            'type'=>1,
            'base_image'=>'public/uploads/shop/demo/mission-icon.png',
        ]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('add_shops');
	}

}
