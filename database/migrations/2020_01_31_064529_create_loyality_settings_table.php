<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoyalitySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyality_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->nullable()->unsigned()->index('loyality_settings_0');
            $table->foreign('game_id','loyality_settings_0')->references('id')
            ->on('add_games')->onDelete('cascade');
            $table->integer('rate');
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
        Schema::dropIfExists('loyality_settings');
    }
}
