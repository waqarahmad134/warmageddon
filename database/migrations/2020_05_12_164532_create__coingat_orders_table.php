<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoingatOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coingat_orders', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->integer('user_id');
            $table->integer('deposit_id')->nullable();
            $table->text('currency');
            $table->text('receive_currency');
            $table->text('deposit_amount');
            $table->text('deposit_usd');
            $table->text('play6_token')->nullable();
            $table->text('bonus_code')->nullable();
            $table->text('processable_token')->nullable();
            $table->text('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_coingat_orders');
    }
}
