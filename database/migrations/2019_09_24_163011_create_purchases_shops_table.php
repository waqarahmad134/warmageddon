<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchases_shops', function(Blueprint $table)
		{
			$table->increments('id');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->integer('shop_id')->nullable()->unsigned()->index('purchases_shops_oo1');
            $table->foreign('shop_id','purchases_shops_oo1')->references('id')->on('add_shops')
            ->onDelete('cascade');

            $table->integer('user_id')->nullable()->unsigned()->index('purchases_shops002');
            $table->foreign('user_id','purchases_shops002')->references('id')->on('users')
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
		Schema::drop('purchases_shops');
	}

}
