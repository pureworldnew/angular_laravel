<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPerTypeTimeProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('per_type_time_product', function(Blueprint $table)
		{
			$table->foreign('per_type_time_id')->references('id')->on('per_type_times')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('per_type_time_product', function(Blueprint $table)
		{
			$table->dropForeign('per_type_time_product_per_type_time_id_foreign');
			$table->dropForeign('per_type_time_product_product_id_foreign');
		});
	}

}
