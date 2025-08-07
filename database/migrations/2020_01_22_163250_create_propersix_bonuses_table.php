67<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropersixBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propersix_bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bonus_name')->nullable();
            $table->string('deposit_method')->nullable();
            $table->integer('min_loss')->nullable();
            $table->string('bonus_code')->nullable();
            $table->string('type')->nullable();
            $table->integer('bonus_amount')->nullable();
            $table->integer('free_spin')->nullable();
            $table->string('game')->nullable();
            $table->integer('bet_size')->default(0);
            $table->integer('lines')->default(0);
            $table->integer('wagering_req')->default(0);
            $table->timestamp('from')->nullable();
            $table->timestamp('till')->nullable();
            $table->timestamp('specific_day')->nullable();
            $table->string('recurring')->nullable();
            $table->string('w_2')->nullable();
            $table->string('ex_country')->nullable();
            $table->string('aff_source')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('percent_amount')->nullable();
            $table->integer('max_amount')->nullable();
            $table->string('chained')->nullable();
            $table->timestamp('ex_chain')->nullable();
            $table->string('users')->nullable();
            $table->string('vip_level')->nullable();
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
        Schema::dropIfExists('propersix_bonuses');
    }
}
