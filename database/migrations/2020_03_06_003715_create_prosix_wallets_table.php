<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProsixWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prosix_wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount')->nullable();
            $table->timestamps();

            $table->integer('type_id')->nullable()->unsigned()->index('prosix_wallets_001');
            $table->foreign('type_id','prosix_wallets_001')->references('id')->on('prosix_wallet_types')
            ->onDelete('cascade');
            
            $table->integer('created_by')->default(1)->unsigned()->index('prosix_wallets_8');
            $table->foreign('created_by','prosix_wallets_8'
            )->references('id')->on('users') ->onDelete('cascade');

            $table->integer('user_id')->default(1)->unsigned()->index('prosix_wallets_89');
            $table->foreign('user_id','prosix_wallets_89'
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
        Schema::dropIfExists('prosix_wallets');
    }
}
