<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPerTypesProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('per_types_product', function(Blueprint $table)
		{
			$table->foreign('per_types_id')->references('id')->on('per_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('per_types_product', function(Blueprint $table)
		{
			$table->dropForeign('per_types_product_per_types_id_foreign');
			$table->dropForeign('per_types_product_product_id_foreign');
		});
	}

}
