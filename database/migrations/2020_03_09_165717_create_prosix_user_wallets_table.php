<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProsixUserWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prosix_user_wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->float('usd',10,2)->nullable();
            $table->float('token',10,2)->nullable();
            $table->float('free_token',10,2)->nullable();
            $table->float('spin',10,2)->nullable();
            $table->float('free_spin',10,2)->nullable();
            $table->timestamps();

            $table->integer('type_id')->nullable()->unsigned()->index('prosix_user_wallets_8');
            $table->foreign('type_id','prosix_user_wallets_8')->references('id')->on('prosix_wallet_types')
            ->onDelete('cascade');
            $table->integer('user_id')->nullable()->unsigned()->index('prosix_user_wallets_90');
            $table->foreign('user_id','prosix_user_wallets_90'
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
        Schema::dropIfExists('prosix_user_wallets');
    }
}
