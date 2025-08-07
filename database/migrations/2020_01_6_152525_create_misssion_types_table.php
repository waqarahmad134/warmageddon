<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMisssionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misssion_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('type_text');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        DB::table('misssion_types')->insert([
            [
                'name'=> 'First Month Bonus',
                'type_text'=> 'Bronze Loyalty (Cash Table Only. Max 0.05/0.10. Heads Up And Fixed Limit Excluded)',
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
        Schema::dropIfExists('misssion_types');
    }
}
