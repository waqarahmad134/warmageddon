<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAffiliateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliate_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('mrp_players', 191);
			$table->integer('mrp_month');
			$table->integer('mrp_deposit');
			$table->integer('affiliate_revenue');
			$table->integer('affiliate_player_bonus');
			$table->string('affiliate_player_bonus_rollover', 50);
			$table->string('is_filterable', 50)->nullable();
			$table->timestamps();
			$table->boolean('status')->nullable()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('affiliate_settings');
	}

}
