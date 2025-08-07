<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_codes', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('user_id')->nullable()->unsigned()->index('bonus_codes');
            $table->foreign('user_id','bonus_codes')->references('id')
            ->on('users')->onDelete('cascade');
            $table->string('bonus_code',50);
            $table->boolean('bonus_type');
            $table->float('bonus',10,2);
            $table->date('valid_date');
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
        Schema::dropIfExists('bonus_codes');
    }
}
