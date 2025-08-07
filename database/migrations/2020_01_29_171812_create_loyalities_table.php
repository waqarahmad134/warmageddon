<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoyalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalities', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name',200);
            $table->integer('from_range');
            $table->integer('to_range');
            $table->text('base_image')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('loyalities')->insert([
            'name'=>'Silver',
            'from_range'=>1,
            'to_range'=>2000,
            'base_image'=>'public/uploads/loyalty/demo/actab-icon1.png',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loyalities');
    }
}
