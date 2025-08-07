<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('buy_tokens_009');
            $table->foreign('user_id','buy_tokens_009')->references('id')->on('users')
            ->onDelete('cascade');
            $table->float('amount', 10, 2)->nullable();
            $table->float('token', 10, 2)->nullable();
            $table->string('charge_id')->nullable();
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
        Schema::dropIfExists('buy_tokens');
    }
}
