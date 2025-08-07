<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('transactions_001');
            $table->foreign('user_id','transactions_001')->references('id')
            ->on('users')->onDelete('cascade');
			$table->string('type', 191)->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
