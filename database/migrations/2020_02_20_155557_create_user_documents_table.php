<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',100)->nullable();
            $table->string('file',240)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->integer('user_id')->nullable()->unsigned()->index('user_documents_002');
            $table->foreign('user_id','user_documents_002')->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_documents');
    }
}
