<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCentreLocalisationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centre_localisation', function(Blueprint $table)
		{
			$table->foreign('centre_id')->references('id')->on('centres')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('centre_localisation', function(Blueprint $table)
		{
			$table->dropForeign('centre_localisation_centre_id_foreign');
		});
	}

}
