<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoyalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_loyalities', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->integer('loyality_id')->nullable()->unsigned()->index('user_loyalities_001');
            $table->foreign('loyality_id','user_loyalities_001')->references('id')->on('loyalities')
            ->onDelete('cascade');

            $table->integer('user_id')->nullable()->unsigned()->index('user_loyalities_004');
            $table->foreign('user_id','user_loyalities_004')->references('id')->on('users')
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
        Schema::dropIfExists('user_loyalities');
    }
}
