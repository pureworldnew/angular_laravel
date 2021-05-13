<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCentreLocalisationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('centre_localisation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('centre_id')->unsigned()->index();
			$table->string('language');
			$table->string('field_name');
			$table->text('field_value', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('centre_localisation');
	}

}
