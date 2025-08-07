<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProsixTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prosix_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('prosix_transactions_1');
            $table->foreign('user_id','prosix_transactions_1')->references('id')
            ->on('users')->onDelete('cascade');

            $table->integer('created_by')->unsigned()->index('prosix_transactions_004');
            $table->foreign('created_by','prosix_transactions_004')->references('id')
            ->on('users')->onDelete('cascade');

            $table->integer('type')->unsigned()->index('prosix_transactions_11');
            $table->foreign('type','prosix_transactions_11')->references('id')
            ->on('transaction_types')->onDelete('cascade');

			$table->integer('amount')->nullable();
			$table->string('currency', 191)->nullable();
			$table->string('from', 191)->nullable();
			$table->string('to', 191)->nullable();
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
        Schema::dropIfExists('prosix_transactions');
    }
}
