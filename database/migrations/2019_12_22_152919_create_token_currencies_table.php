<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->nullable();
            $table->float('doller',10,2)->nullable();
            $table->float('pley6_token',10,2)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('token_currencies')->insert([
			[
				'doller' =>1,
				'pley6_token' =>10
			]
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token_currencies');
    }
}
