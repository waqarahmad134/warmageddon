<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_bonus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('deposit_id');
            $table->integer('user_id');
            $table->integer('aff_id');
            $table->integer('amount')->nullable();
            $table->integer('tokens')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('affiliate_bonus');
    }
}
