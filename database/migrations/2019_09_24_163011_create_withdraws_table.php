<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWithdrawsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('withdraws', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 100)->nullable();
			$table->string('last_name', 100)->nullable();
			$table->string('w_country', 100)->nullable();
			$table->string('w_state', 100)->nullable();
			$table->string('zipcode', 100)->nullable();
			$table->text('Address')->nullable();
			$table->string('w_currency', 100)->nullable();
			$table->float('amount',10,2)->nullable();
			$table->integer('payment_mathod_type')->nullable();
			$table->integer('w_card')->nullable();
			$table->string('date')->nullable();
			$table->integer('cvc')->nullable();
			$table->string('w_bank_name')->nullable();
			$table->string('w_account_number')->nullable();
			$table->string('IBAN')->nullable();
			$table->string('SWIFT')->nullable();
            $table->boolean('status')->default(0);
			$table->timestamps();

			$table->integer('user_id')->nullable()->unsigned()->index('withdraws_001');
            $table->foreign('user_id','withdraws_001')->references('id')->on('users')
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
		Schema::drop('withdraws');
	}

}
