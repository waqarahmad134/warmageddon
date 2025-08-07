<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_notes', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('user_id')->nullable()->unsigned()->index('leave_notes_oo2');
            $table->foreign('user_id','leave_notes_oo2')->references('id')
            ->on('users')->onDelete('cascade');
            $table->longText('body');
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
        Schema::dropIfExists('leave_notes');
    }
}
