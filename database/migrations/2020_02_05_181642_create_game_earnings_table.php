<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_earnings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned()->index('game_earnings_002');
            $table->foreign('user_id','game_earnings_002')->references('id')
            ->on('users')->onDelete('cascade');
            $table->integer('game_id')->nullable()->unsigned()->index('game_earnings_01');
            $table->foreign('game_id','game_earnings_01')->references('id')
            ->on('add_games')->onDelete('cascade');
            $table->integer('spin')->nullable();
            $table->integer('token')->nullable();
            $table->integer('betsize')->nullable();
            $table->integer('line')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('game_earnings');
    }
}
