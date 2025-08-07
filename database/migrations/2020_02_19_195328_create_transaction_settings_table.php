<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('withdraw',100)->nullable();
            $table->string('deposit',100)->nullable();
            $table->string('transfer',100)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        DB::table('transaction_settings')->insert([
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
        Schema::dropIfExists('transaction_settings');
    }
}
