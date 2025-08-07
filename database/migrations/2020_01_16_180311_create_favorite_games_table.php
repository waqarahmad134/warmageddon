<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_games', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('user_id')->nullable()->unsigned()->index('favorite_games_001');
            $table->foreign('user_id','favorite_games_001')->references('id')->on('users')
            ->onDelete('cascade');

            $table->integer('game_id')->nullable()->unsigned()->index('favorite_games_005');
            $table->foreign('game_id','favorite_games_005')->references('id')
            ->on('add_games')->onDelete('cascade');
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
        Schema::dropIfExists('favorite_games');
    }
}
