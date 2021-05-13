<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCentreUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centre_user', function(Blueprint $table)
		{
			$table->foreign('centre_id')->references('id')->on('centres')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_type_id')->references('id')->on('user_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('centre_user', function(Blueprint $table)
		{
			$table->dropForeign('centre_user_centre_id_foreign');
			$table->dropForeign('centre_user_user_id_foreign');
			$table->dropForeign('centre_user_user_type_id_foreign');
		});
	}

}
