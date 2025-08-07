<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191);
			$table->string('email', 100)->unique();
			$table->string('password', 191);
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
		});

	 $user=new \App\Admin();
	 $user->name= 'properadmin';
	 $user->email= 'propersix@gmail.com';
	 $user->password=Hash::make('AdZpDmn@105296HHrt');
	 $user->remember_token='1HhUZcCWDJZUrfdrvvEuo86EzcdYi1pF5v2qCjteKNYVMd9oRO8zIKLJd4lm';
	 $user->save();
   }



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admins');
	}

}
