<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerTypeTimesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('per_type_times', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type_time_name');
			$table->string('type_time_value');
			$table->string('lang', 2);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('per_type_times');
	}

}
