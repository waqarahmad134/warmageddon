<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('guard_name', 191);
			$table->timestamps();
		});

		DB::table('roles')->insert([
            [
                'name' => 'Super Admin',    //      1
                'guard_name' => 'web',    //      1
            ],
            [
				'name' => 'Admin',    //      1
				'guard_name' => 'web',    //      1
            ],
            [
				'name' => 'Agent',    //      1
				'guard_name' => 'web',    //      1
            ],
            [
				'name' => 'Operator',    //      2
				'guard_name' => 'web',    //      1
            ],
            [
				'name' => 'User',    //      2
				'guard_name' => 'web',    //      1
            ]

		]);
		DB::table('role_has_permissions')->insert([
			[
				'permission_id' =>1,
				'role_id' =>1
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
		Schema::drop('roles');
	}

}
