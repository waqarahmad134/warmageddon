<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('wager_amount')->nullable();
            $table->integer('total_spin')->nullable();
            $table->integer('prize')->nullable();
            $table->timestamp('specific_day')->nullable();
            $table->string('date_m')->nullable();
            $table->string('d_m')->nullable();
            $table->string('base_image')->nullable();
            $table->longText('text')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('mission_bonuses')->insert([
            [
                'name'=> 'Play 15 cash games hands',
                'amount' => 200,
                'prize' => 1,
                'wager_amount' => 500,
                'total_spin' => 100,
                'date_m' => 'w',
                'd_m' => 'Sat',
                'base_image' =>'public/uploads/mission/demo/mission-icon1.png'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mission_bonuses');
    }
}
