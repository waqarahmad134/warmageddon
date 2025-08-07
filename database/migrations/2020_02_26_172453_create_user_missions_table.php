<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_missions', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->integer('mission_id')->nullable()->unsigned()->index('user_missions_001');
            $table->foreign('mission_id','user_missions_001')->references('id')->on('mission_bonuses')
            ->onDelete('cascade');

            $table->integer('user_id')->nullable()->unsigned()->index('user_missions_002');
            $table->foreign('user_id','user_missions_002')->references('id')->on('users')
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
        Schema::dropIfExists('user_missions');
    }
}
