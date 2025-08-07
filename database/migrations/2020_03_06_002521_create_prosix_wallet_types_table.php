<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProsixWalletTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prosix_wallet_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',200);
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->integer('created_by')->default(1)->unsigned()->index('prosix_wallet_types_0');
            $table->foreign('created_by','prosix_wallet_types_0'
            )->references('id')->on('users') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prosix_wallet_types');
    }
}
